<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		//dohvati sve postove
		//$posts = Post::all();
		//dd($posts);
		
		//dohvati post koji ima id=1
		//$posts = Post::find(1);
		//dd($posts->title);
		//dd($posts->content);
		
		//dd($posts->user);
		//dd($posts->user->email);
		
	    //uvjet
		//$posts = Post::where('id',3)->get();
		//dd($posts);
		
		//$posts = Post::where('id','<',4)->get();
		//dd($posts);
		
		//sortiranje
		//metoda get vraca kolekciju
		//$posts = Post::where('id','<',4)->orderBy('title', 'desc')->get();
		//dd($posts);
		
		//metoda first vraca objekt
		//$posts = Post::where('id','<',4)->first();
		//dd($posts);
		
		//$posts = Post::select('title')->get();
		//dd($posts);
		
		//metoda paginate prikazuje zadani broj postova po stranici
		//$posts = Post::where('id','<',4)->paginate(5);
		//metoda paginate ce prikazati jedan post po stranici
		//$posts = Post::paginate(1);
		//metoda paginate ce prikazati dva post-a po stranici
		//$posts = Post::paginate(2);
		//dd($posts);
		
		$posts = Post::orderBy('created_at', 'desc')->paginate(20);
		
 		return view('index')->with('posts', $posts);
    }

   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    
}
