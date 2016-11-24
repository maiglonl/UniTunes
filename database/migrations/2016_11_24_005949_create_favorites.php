<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavorites extends Migration{
   public function up(){
		Schema::create('favorites', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('idMedia')->unsigned();
			$table->integer('idUser')->unsigned();
			$table->integer('typeMedia')->unsigned()->nullable();
			$table->timestamps();
			$table->index(['idUser', 'idMedia']);
		});
	}

	public function down(){
		Schema::dropIfExists('favorites');
	}
}
