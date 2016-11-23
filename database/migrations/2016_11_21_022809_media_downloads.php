<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MediaDownloads extends Migration{
    public function up(){
		Schema::table('medias', function ($table) {
			$table->integer('downloads')->nullable()->default(0);
		});
	}

	public function down(){
		Schema::table('medias', function ($table) {
			$table->dropColumn(['downloads']);
		});
	}
}
