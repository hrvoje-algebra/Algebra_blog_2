<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
	use Sluggable;
	
	// Mass assignable attributes
    protected $fillable = ['title', 'slug', 'content', 'user_id'];
	
	// Post model namespace
    protected static $userModel = 'App\Models\User';
	
	public function user()
	{
		// prvi argument je putanja do model-a
		// drugi argument stupac u bazi preko kojeg radimo relaciju
		return $this->belongsTo(static::$userModel, 'user_id');
	}
	
	 /**
     * Save Post
     *
	 * @param array $post
     * @return post object
     */
	 public function savePost($post)
	 {
		 // fill + save spremaju u bazu, ali ne vracaju Post objekt
		 //return $this->fill($post)->save();
		 // create sprema u bazu i vraca Post objekt na controller
		 return $this->create($post);
	 }
	 
	  /**
     * Update Post
     *
	 * @param array $post
     * @return post object
     */
	 public function updatePost($post)
	 {
		 return $this->update($post);
	 }
	 
	
	
	 /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
