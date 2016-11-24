<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MediaController;

class HomeController extends Controller{
	public function __construct(){
		$this->middleware('auth');
	}

	public function welcome(){
		if(Auth::user()){
			if(Auth::user()->profile == 1){
				return MediaController::musicsHome();
			}else{
				return UserController::dashboard();
			}
		}else{
			return view('auth.login');
		}
	}
	public function home(){
		if(Auth::user()->profile == 1){
			return MediaController::musicsHome();
		}else{
			return UserController::dashboard();
		}
	}
}
