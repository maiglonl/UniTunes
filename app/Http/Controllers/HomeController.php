<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller{
	public function __construct(){
		$this->middleware('auth');
	}

	public function welcome(){
		if(Auth::user()){
			return view('home');
		}else{
			return view('auth.login');
		}
	}
	public function home(){
		return view('home');
	}
}
