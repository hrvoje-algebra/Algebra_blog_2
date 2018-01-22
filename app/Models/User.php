<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser;

class User extends EloquentUser
{
	
	// Post model namespace
    protected static $postModel = 'App\Models\Post';
	
	public function posts()
	{
		// prvi argument je putanja do model-a
		// drugi argument stupac u bazi preko kojeg radimo relaciju
		return $this->hasMany(static::$postModel, 'user_id');
	}
}
