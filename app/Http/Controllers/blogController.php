<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
class blogController extends Controller
{
	public function getArchive()
	{
		$posts = Post::paginate(2);
		return view('blog.index')->withPosts($posts);
	}
    public function getSingle($slug)
    {

       // fetch from the Db based on slug
    	$post = Post::where('slug','=', $slug)->first();

    	//return the view and pass in post object
    	return view('blog.single')->withpost($post);
    }
}
