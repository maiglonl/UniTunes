<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMedias extends Migration{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		Schema::table('medias', function ($table) {
			$table->string('imageExt')->nullable();
			$table->string('mediaExt')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		$table->dropColumn(['imageExt']);
		$table->dropColumn(['mediaExt']);
	}
}
