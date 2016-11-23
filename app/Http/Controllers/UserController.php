<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Medias;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller{
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
		return view('users.profile', [
			'author' => $author,
			'musics' => $musics,
			'videos' => $videos,
			'podcasts' => $podcasts,
			'books' => $books,
			'uploads' => $uploads,
			'isAdmin' => $isAdmin
		]);
	}

	public function deleteUser($id){
		$user = User::find($id);
		$user->delete();
		return Redirect::to('home');
	}
}
