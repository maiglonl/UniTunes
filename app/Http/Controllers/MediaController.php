<?php

namespace App\Http\Controllers;

use Auth;
use File;
use Response;
use App\Medias;
use App\User;
use App\Trades;
use App\Favorites;
use App\Categories;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MediaController extends Controller{
	public function __construct(){
		$this->middleware('auth');
	}

	public function buyMedia($id){
		$media = Medias::find($id);
		$owner = User::find($media->idUser);
		$user = Auth::user();
		$admin = User::find(3);
		$canBuy = $user->credits > $media->price;

		if($canBuy){
			$admin->credits += $media->price * 0.1;
			$admin->save();

			$owner->credits += $media->price * 0.9;
			$owner->save();

			$user->credits -= $media->price;
			$user->save();

			$trade = new Trades;
			$trade->price = $media->price;
			$trade->idUser = $user->id;
			$trade->idMedia = $media->id;
			$trade->save();

			return redirect()->route('medias.receipt', ['id' => $trade->id]);
		}else{	
			return redirect()->route('musics.home');
		}
	}
	public function downloadMedia($id){
		$media = Medias::find($id);
		$fileName = $media->authors."_".$media->name.".".$media->mediaExt;
		$filePath = "storage/medias/".$media->id.".".$media->mediaExt;
		if (file_exists($filePath)){
			$media->downloads++;
			$media->save();
			// Send Download
			return Response::download($filePath, $fileName, [
				'Content-Length: '. filesize($filePath)
			]);
		}
		else{
			exit('Requested file does not exist on our server!');
		}
	}
	public function deleteMedia($id){
		$media = Medias::find($id);

		// Delete Media File
		$fileName = $media->id.".".$media->mediaExt;
		$filePath = "storage/medias/".$fileName;
		File::delete($filePath);

		// Delete Image File
		$fileName = $media->id.".".$media->imageExt;
		$filePath = "storage/images/".$fileName;
		File::delete($filePath);

		$media->delete();
		return Redirect::to('home');
	}
	public function postMedia(Requests\MediasRequest $request){
		try {
			$request->request->add([
				'idUser' => Auth::user()->id
			]);
			$media = Medias::create($request->except(["_token", "image", "media"]));

			$user = User::find(Auth::user()->id);
			if($user->profile == 1){
				$user->profile = 2;
				$user->save();
			}

			// upload the image //
			$file = $request->image;
			$destination_path = 'storage/images';
			$extension = $request->image->getClientOriginalExtension();
			$filename = $media->id.'.'.$extension;
			$file->move($destination_path, $filename);
			$media->imageExt = $extension;

			// upload the image //
			$file = $request->media;
			$destination_path = 'storage/medias';
			$extension = $request->media->getClientOriginalExtension();
			$filename = $media->id.'.'.$extension;
			$file->move($destination_path, $filename);
			$media->mediaExt = $extension;
			$media->save();

			return Redirect::back()->with("success", "Midia adicionada.");
		} catch (Exception $e) {
			return Redirect::back()->withErrors(["Falha ao adicionar nova midia."]);
		}
	}
	public function getReceipt($id){
		$trade = Trades::find($id);
		$media = Medias::find($trade->idMedia);
		$seller = User::find($media->idUser);
		$buyer = User::find($trade->idUser);
		return view('trades.receipt', [
			'trade' => $trade,
			'seller' => $seller,
			'buyer' => $buyer,
			'media' => $media
		]);
	}
	public function setFavorite($idMedia){
		$count = DB::table('favorites')
			->where([
				['idMedia', $idMedia],
				['idUser', Auth::id()],
			])
			->count();
		if($count == 0){
			$media = Medias::find($idMedia);
			$fav = new Favorites;
			$fav->idMedia = $idMedia;
			$fav->typeMedia = $media->typeMedia;
			$fav->idUser = Auth::id();
			$fav->save();
		}
	}
	public function unsetFavorite($id){
		$fav = DB::table('favorites')
			->where([
				['idMedia', '=', DB::raw($id)],
				['idUser', '=', DB::raw(Auth::id())]
			])
			->get()[0];
		$favorite = Favorites::find($fav->id);
		$favorite->delete();
	}


	public static function musicsHome(){
		// Novidades
		$musics = DB::table('medias')
			->leftJoin('favorites', function($join){
				$join->on('favorites.idMedia', '=', 'medias.id');
				$join->on('favorites.idUser', '=', DB::raw(Auth::id()));
			})
			->where('medias.typeMedia', '1')
			->orderBy('medias.updated_at', 'desc')
			->limit(12)
			->get(['medias.*', 'favorites.id AS idFavorite']);

		// Favoritos
		$favorites = DB::table('medias')
			->leftJoin('favorites', function($join){
				$join->on('favorites.idMedia', '=', 'medias.id');
				$join->on('favorites.idUser', '=', DB::raw(Auth::id()));
			})
			->where([
				['medias.typeMedia','=' , DB::raw('1')],
				['favorites.id', '>', DB::raw('0')] 
			])
			->orderBy('favorites.updated_at', 'desc')
			->get(['medias.*', 'favorites.id AS idFavorite']);

		// Mais Baixadas
		$tops = DB::table('medias')
			->where('typeMedia', '1')
			->orderBy('downloads', 'desc')
			->limit(10)
			->get();

		return view('musics.home', [
			'musics' => $musics,
			'tops' => $tops,
			'favorites' => $favorites
		]);
	}
	public function musicsNewMedia(){
		$categs = DB::table('categories')->where('typeMedia', '1')->orderBy('name')->get();
		return view('musics.new', ['categs' => $categs]);
	}
	public function musicsDetails($id){
		$isAdmin = Auth::user()->profile == 0 ? true : false;
		$music = Medias::find($id);
		$owner = User::find($music->idUser);
		$category = Categories::find($music->idCategory);
		$uploads = DB::table('medias')
			->where(['idUser' => $owner->id])
			->count();
		$musics = DB::table('medias')
			->where('authors', $music->authors)
			->orderBy('updated_at', 'desc')
			->get();
		$isOwner = $owner->id == Auth::id();
		$trade = DB::table('trades')
			->where([
				['idMedia', $music->id],
				['idUser', Auth::id()],
			])
			->count();

		$favorite = DB::table('favorites')
			->where([
				'idMedia' => $music->id,
				'idUser' => Auth::id(),
			])
			->orderBy('updated_at', 'desc')
			->first();

		$canDownload = $isOwner || $music->price == 0 || $trade > 0;

		return view('musics.details', [
			'music' => $music,
			'owner' => $owner,
			'musics' => $musics,
			'category' => $category,
			'uploads' => $uploads,
			'isOwner' => $isOwner,
			'canDownload' => $canDownload,
			'isAdmin' => $isAdmin,
			'favorite' => $favorite
		]);
	}
	public function musicsList($id){
		$categs = DB::table('categories')->where('typeMedia', '1')->orderBy('name')->get();
		if($id == 0){
			$favorites = DB::table('medias')
				->leftJoin('favorites', function($join){
					$join->on('favorites.idMedia', '=', 'medias.id');
					$join->on('favorites.idUser', '=', DB::raw(Auth::id()));
				})
				->where([
					['medias.typeMedia','=' , DB::raw('1')],
					['favorites.id', '>', DB::raw('0')]
				])
				->orderBy('favorites.updated_at', 'desc')
				->get(['medias.*', 'favorites.id AS idFavorite']);

			$musics = DB::table('medias')
				->leftJoin('favorites', function($join){
					$join->on('favorites.idMedia', '=', 'medias.id');
					$join->on('favorites.idUser', '=', DB::raw(Auth::id()));
				})
				->where('medias.typeMedia', '1')
				->orderBy('medias.updated_at', 'desc')
				->limit(12)
				->get(['medias.*', 'favorites.id AS idFavorite']);
			$categName = "Todas";
		}else{
			$favorites = DB::table('medias')
				->leftJoin('favorites', function($join){
					$join->on('favorites.idMedia', '=', 'medias.id');
					$join->on('favorites.idUser', '=', DB::raw(Auth::id()));
				})
				->where([
					['medias.typeMedia','=' , DB::raw('1')],
					['favorites.id', '>', DB::raw('0')],
					['medias.idCategory', '=', DB::raw($id)]
				])
				->orderBy('favorites.updated_at', 'desc')
				->get(['medias.*', 'favorites.id AS idFavorite']);

			$musics = DB::table('medias')
				->leftJoin('favorites', function($join){
					$join->on('favorites.idMedia', '=', 'medias.id');
					$join->on('favorites.idUser', '=', DB::raw(Auth::id()));
				})
				->where([
					['medias.typeMedia','=' , DB::raw('1')],
					['medias.idCategory', '=', DB::raw($id)]
				])
				->orderBy('medias.updated_at', 'desc')
				->limit(12)
				->get(['medias.*', 'favorites.id AS idFavorite']);
				$categName = Categories::find($id)->name;
		}

		return view('musics.list', [
			'categories' => $categs,
			'favorites' => $favorites,
			'musics' => $musics,
			'cotegorie' => $id,
			'categName' => $categName
		]);
	}

	public function videosHome(){
		// Novidades
		$news = DB::table('medias')
			->leftJoin('favorites', function($join){
				$join->on('favorites.idMedia', '=', 'medias.id');
				$join->on('favorites.idUser', '=', DB::raw(Auth::id()));
			})
			->where('medias.typeMedia', '2')
			->orderBy('medias.updated_at', 'desc')
			->limit(3)
			->get(['medias.*', 'favorites.id AS idFavorite']);

		// Recentes
		$recents = DB::table('medias')
			->leftJoin('favorites', function($join){
				$join->on('favorites.idMedia', '=', 'medias.id');
				$join->on('favorites.idUser', '=', DB::raw(Auth::id()));
			})
			->where('medias.typeMedia', '2')
			->orderBy('medias.updated_at', 'desc')
			->limit(12)
			->get(['medias.*', 'favorites.id AS idFavorite']);

		return view('videos.home', [
			'news' => $news,
			'recents' => $recents
		]);
	}
	public function videosNewMedia(){
		$categs = DB::table('categories')->where('typeMedia', '2')->orderBy('name')->get();
		return view('videos.new', ['categs' => $categs]);
	}
	public function videosDetails($id){
		$isAdmin = Auth::user()->profile == 0 ? true : false;
		$video = Medias::find($id);
		$owner = User::find($video->idUser);
		$category = Categories::find($video->idCategory);
		$uploads = DB::table('medias')
			->where(['idUser' => $owner->id])
			->count();
		$videos = DB::table('medias')
			->where('authors', $video->authors)
			->orderBy('updated_at', 'desc')
			->get();
		$isOwner = $owner->id == Auth::id();
		$trade = DB::table('trades')
			->where([
				['idMedia', $video->id],
				['idUser', Auth::id()],
			])
			->count();
		$favorite = DB::table('favorites')
			->where([
				'idMedia' => $video->id,
				'idUser' => Auth::id(),
			])
			->orderBy('updated_at', 'desc')
			->first();

		$canDownload = $isOwner || $video->price == 0 || $trade > 0;

		return view('videos.details', [
			'video' => $video,
			'owner' => $owner,
			'videos' => $videos,
			'category' => $category,
			'uploads' => $uploads,
			'isOwner' => $isOwner,
			'canDownload' => $canDownload,
			'isAdmin' => $isAdmin,
			'favorite' => $favorite
		]);
	}

	public function booksHome(){
		// Novidades
		$books = DB::table('medias')
			->leftJoin('favorites', function($join){
				$join->on('favorites.idMedia', '=', 'medias.id');
				$join->on('favorites.idUser', '=', DB::raw(Auth::id()));
			})
			->where('medias.typeMedia', '4')
			->orderBy('medias.updated_at', 'desc')
			->limit(12)
			->get(['medias.*', 'favorites.id AS idFavorite']);

		// Favoritos
		$favorites = DB::table('medias')
			->leftJoin('favorites', function($join){
				$join->on('favorites.idMedia', '=', 'medias.id');
				$join->on('favorites.idUser', '=', DB::raw(Auth::id()));
			})
			->where([
				['medias.typeMedia','=' , DB::raw('4')],
				['favorites.id', '>', DB::raw('0')] 
			])
			->orderBy('favorites.updated_at', 'desc')
			->get(['medias.*', 'favorites.id AS idFavorite']);

		// Mais Baixadas
		$tops = DB::table('medias')
			->where('typeMedia', '4')
			->orderBy('downloads', 'desc')
			->limit(10)
			->get();

		return view('books.home', [
			'books' => $books,
			'tops' => $tops,
			'favorites' => $favorites
		]);
	}
	public function booksNewMedia(){
		$categs = DB::table('categories')->where('typeMedia', '4')->orderBy('name')->get();
		return view('books.new', ['categs' => $categs]);
	}
	public function booksDetails($id){
		$isAdmin = Auth::user()->profile == 0 ? true : false;
		$book = Medias::find($id);
		$owner = User::find($book->idUser);
		$category = Categories::find($book->idCategory);
		$uploads = DB::table('medias')
			->where(['idUser' => $owner->id])
			->count();
		$books = DB::table('medias')
			->where('authors', $book->authors)
			->orderBy('updated_at', 'desc')
			->get();
		$isOwner = $owner->id == Auth::id();
		$trade = DB::table('trades')
			->where([
				['idMedia', $book->id],
				['idUser', Auth::id()],
			])
			->count();
		$favorite = DB::table('favorites')
			->where([
				'idMedia' => $book->id,
				'idUser' => Auth::id(),
			])
			->orderBy('updated_at', 'desc')
			->first();

		$canDownload = $isOwner || $book->price == 0 || $trade > 0;

		return view('books.details', [
			'book' => $book,
			'owner' => $owner,
			'books' => $books,
			'category' => $category,
			'uploads' => $uploads,
			'isOwner' => $isOwner,
			'canDownload' => $canDownload,
			'isAdmin' => $isAdmin,
			'favorite' => $favorite
		]);
	}
	public function booksList($id){
		$categs = DB::table('categories')->where('typeMedia', '4')->orderBy('name')->get();
		if($id == 0){
			$favorites = DB::table('medias')
				->leftJoin('favorites', function($join){
					$join->on('favorites.idMedia', '=', 'medias.id');
					$join->on('favorites.idUser', '=', DB::raw(Auth::id()));
				})
				->where([
					['medias.typeMedia','=' , DB::raw('4')],
					['favorites.id', '>', DB::raw('0')]
				])
				->orderBy('favorites.updated_at', 'desc')
				->get(['medias.*', 'favorites.id AS idFavorite']);

			$books = DB::table('medias')
				->leftJoin('favorites', function($join){
					$join->on('favorites.idMedia', '=', 'medias.id');
					$join->on('favorites.idUser', '=', DB::raw(Auth::id()));
				})
				->where('medias.typeMedia', '4')
				->orderBy('medias.updated_at', 'desc')
				->limit(12)
				->get(['medias.*', 'favorites.id AS idFavorite']);
			$categName = "Todas";
		}else{
			$favorites = DB::table('medias')
				->leftJoin('favorites', function($join){
					$join->on('favorites.idMedia', '=', 'medias.id');
					$join->on('favorites.idUser', '=', DB::raw(Auth::id()));
				})
				->where([
					['medias.typeMedia','=' , DB::raw('4')],
					['favorites.id', '>', DB::raw('0')],
					['medias.idCategory', '=', DB::raw($id)]
				])
				->orderBy('favorites.updated_at', 'desc')
				->get(['medias.*', 'favorites.id AS idFavorite']);

			$books = DB::table('medias')
				->leftJoin('favorites', function($join){
					$join->on('favorites.idMedia', '=', 'medias.id');
					$join->on('favorites.idUser', '=', DB::raw(Auth::id()));
				})
				->where([
					['medias.typeMedia','=' , DB::raw('4')],
					['medias.idCategory', '=', DB::raw($id)]
				])
				->orderBy('medias.updated_at', 'desc')
				->limit(12)
				->get(['medias.*', 'favorites.id AS idFavorite']);
				$categName = Categories::find($id)->name;
		}

		return view('books.list', [
			'categories' => $categs,
			'favorites' => $favorites,
			'books' => $books,
			'cotegorie' => $id,
			'categName' => $categName
		]);
	}
	public function podcastsHome(){
		return view('podcasts.home');
	}
	public function podcastsNewMedia(){
		return view('podcasts.new');
	}
	public function podcastsDetails($id){
		return view('podcasts.details');
	}

}
