<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrades extends Migration{
   public function up(){
		Schema::create('trades', function (Blueprint $table) {
			$table->increments('id');
			$table->double('price', 3,2);
			$table->timestamps();
		});

		Schema::table('trades', function ($table) {
			$table->integer('idMedia')->unsigned()->nullable();
			$table->integer('idUser')->unsigned()->nullable();
			$table->index(['idUser', 'idMedia']);
		});
	}

	public function down(){
		Schema::dropIfExists('trades');
	}
}
