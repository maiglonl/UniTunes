<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Medias;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller{
	public function __construct(){
		$this->middleware('auth');
	}

	public function profile($id){
		$isAdmin = Auth::user()->profile == 0 ? true : false;
		$author = User::find($id);
		$musics = DB::table('medias')
			->where([
				'typeMedia' => '1',
				'idUser' => $id
			])
			->orderBy('updated_at', 'desc')
			->get();
		$videos = DB::table('medias')
			->where([
				'typeMedia' => '2',
				'idUser' => $id
			])
			->orderBy('updated_at', 'desc')
			->get();
		$podcasts = DB::table('medias')
			->where([
				'typeMedia' => '3',
				'idUser' => $id
			])
			->orderBy('updated_at', 'desc')
			->get();
		$books = DB::table('medias')
			->where([
				'typeMedia' => '4',
				'idUser' => $id
			])
			->orderBy('updated_at', 'desc')
			->get();
		$uploads = DB::table('medias')
			->where(['idUser' => $author->id])
			->count();
		$purchases = DB::table('trades')
			->where(['idUser' => $id])
			->count();
		$sales = DB::table('trades')
			->leftJoin('medias', 'trades.idMedia', '=', 'medias.id')
			->where(['medias.idUser' => $id])
			->count();
		$canDelete = $isAdmin || ($author->id == Auth::id() && $author->profile > 0);

		return view('users.profile', [
			'author' => $author,
			'musics' => $musics,
			'videos' => $videos,
			'podcasts' => $podcasts,
			'books' => $books,
			'uploads' => $uploads,
			'isAdmin' => $isAdmin,
			'purchases' => $purchases,
			'sales' => $sales,
			'canDelete' => $canDelete
		]);
	}

	public function home(){
		return $this->profile(Auth::id());
	}

	public function usersList(){
		$admin = DB::table('users')
			->where(['profile' => '0'])
			->orderBy('updated_at', 'desc')
			->get();
		$authors = DB::table('users')
			->where(['profile' => '2'])
			->orderBy('updated_at', 'desc')
			->get();
		$academics = DB::table('users')
			->where(['profile' => '1'])
			->orderBy('updated_at', 'desc')
			->get();
		return view('users.list', [
			'admins' => $admin,
			'authors' => $authors,
			'academics' => $academics
		]);
	}

	public function credit(Request $request){
		$user = User::find($request->idUser);
		$user->credits += $request->value;
		$user->save();
	}

	public function deleteUser($id){
		$isAdmin = Auth::user()->profile == 0;
		$itself = Auth::id() == $id;
		$user = User::find($id);
		if(($isAdmin || $itself) && $user->profile > 0){
			$user->delete();
		}
		return Redirect::to('home');
	}
}
