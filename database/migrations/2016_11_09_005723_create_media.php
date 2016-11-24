<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedia extends Migration{
	public function up(){
		Schema::create('medias', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->text('description');
			$table->double('price', 9,2);
			$table->string('authors');
			$table->integer('typeMedia');
			$table->string('duration')->nullable();
			$table->integer('pages')->nullable();
			$table->timestamps();
		});

		Schema::table('medias', function ($table) {
			$table->integer('idCategory')->unsigned()->nullable();
			$table->foreign('idCategory')->references('id')->on('categories');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		Schema::dropIfExists('media');
	}
}
