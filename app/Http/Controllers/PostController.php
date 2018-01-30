<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\StorePost;
use Sentinel;

class PostController extends Controller
{
	
	public function __construct()
	{
		$this->middleware('sentinel.auth');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {	
		if(Sentinel::inRole('administrator'))
		{
			$posts = Post::orderBy('created_at', 'desc')->paginate(20);
			
		}else{
			$user_id = Sentinel::getUser()->id;
			$posts = Post::where('user_id', $user_id)->orderBy('created_at', 'desc')->paginate(20);
		}
		
		//dd($posts);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {	
		//vidimo da je isti csrf token u sesiji i u formi
        //dd($request);
		
		//dohvacamo podatke koje zelimo spremiti
		$post = array(
			'title'		=> $request->get('title'),
			'content'	=> $request->get('content'),
			'user_id'	=> Sentinel::getUser()->id
		);
		
		//dd($post);
		
		$new_post = new Post();
		
		$data = $new_post->savePost($post);
		
		//dd($data);
		
		session()->flash('success', 'You have successfully created a new post');
		return redirect()->route('posts.index');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
		//dd($post);
		
		if(Sentinel::getUser()->id === $post->user_id || Sentinel::inRole('administrator')){
			//echo 'Moze';
			return view('posts.edit')->with('post', $post);
		}else{
			session()->flash('info', 'You are not authorized to edit this post');
			return redirect()->route('posts.index');
		}
		
			
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {
        $post = Post::findOrFail($id);
		
		//dohvacamo podatke koje zelimo update-ti
		$post_data = array(
			'title'		=> $request->get('title'),
			'content'	=> $request->get('content'),
		);
		
	    if(Sentinel::getUser()->id === $post->user_id || Sentinel::inRole('administrator')){
			$post->updatePost($post_data);
		}else{
			session()->flash('info', 'You are not authorized to edit this post');
			return redirect()->route('posts.index');
		}
		
		session()->flash('success', 'You have successfully updated this post');
		return redirect()->route('posts.index');
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $post = Post::findOrFail($id);
	   
	   if(Sentinel::getUser()->id === $post->user_id || Sentinel::inRole('administrator')){
			$post->delete();
	   }else{
			session()->flash('info', 'You are not authorized to delete this post');
			return redirect()->route('posts.index');
	   }
	   
	   session()->flash('success', 'You have successfully deleted this post');
	   return redirect()->route('posts.index');
	   
    }
}
