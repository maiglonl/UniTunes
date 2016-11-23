<?php

namespace App\Http\Controllers;

use Auth;
use File;
use Response;
use App\Medias;
use App\User;
use App\Trades;
use App\Categories;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
			$id = $trade->save();

			return redirect()->route('medias.receipt', ['id' => $id]);
		}else{	
			return redirect()->route('musics.home');
		}
	}
	public function downloadMedia($id){
		$media = Medias::find($id);
		$fileName = $media->id.".".$media->mediaExt;
		$filePath = "storage/medias/".$fileName;
		if (file_exists($filePath)){
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

	public function musicsHome(){
		$musics = DB::table('medias')
			->where('typeMedia', '1')
			->orderBy('updated_at', 'desc')
			->limit(12)
			->get();
		return view('musics.home', ['musics' => $musics]);
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

		$canDownload = $isOwner || $music->price == 0 || $trade > 0;

		return view('musics.details', [
			'music' => $music,
			'owner' => $owner,
			'musics' => $musics,
			'category' => $category,
			'uploads' => $uploads,
			'isOwner' => $isOwner,
			'canDownload' => $canDownload,
			'isAdmin' => $isAdmin
		]);
	}

	public function videosHome(){
		return view('videos.home');
	}
	public function videosNewMedia(){
		return view('videos.new');
	}
	public function videosDetails($id){
		return view('videos.details');
	}

	public function booksHome(){
		return view('books.home');
	}
	public function booksNewMedia(){
		return view('books.new');
	}
	public function booksDetails($id){
		return view('books.details');
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
