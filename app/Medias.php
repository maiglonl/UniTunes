<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medias extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'description', 'idCategory', 'authors', 'price', 'duration', 'typeMedia', 'idUser', 'pages'
	];
}
