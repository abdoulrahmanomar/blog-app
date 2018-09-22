<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use lists;
use Session;
use Image;

class postController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Creat a variable and store all the blog posts in it form the database
        $posts = Post::orderBy('id','desc')->paginate(2);
        //return a view and pass in the above vriable
        return view('posts.index')->withposts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $cat =Category::all();
        return view('posts.create')->withcat($cat)->withtags($tags);
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        


        $this->validate($request ,array(
            'title'=>'required|max:225',
            'slug'=>'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id'=>'required|numeric',
            'body'=>'required'

        ));
        //validate Data
        $post = new Post;
        $post->title = $request->title;
        $post->slug =$request->slug;
        $post->body= $request->body;
        $post->category_id= $request->category_id;

        if($request->hasFile('image')){
            $image = $request->file('image');
             $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/images');
           
            $image->move($destinationPath, $input['imagename']);
            $post->destinationPath=$destinationPath;
           return back()->with('success','Image Upload successful');
       }
        $post->save();//store in the database
        $post->tags()->sync($request->tags,false);

        Session::flash('success','The Blog Post Was successfully save!');

         
         return redirect()->route('posts.show',$post->id);
        //direct to another page
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
         

        return view('posts.show')->withPost($post);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //find the post in the database and save it as variable
        $post=Post::find($id);
        $categories = Category::pluck('name','id');
        $tags = Tag::all();
        $tags2=array();
        foreach($tags as $tag)
        {
            $tags2[$tag->id] = $tag->name;
        }
        //return the view and pass in the var we previously created 
        return view('posts.edit')->withpost($post)->withcategories($categories)->withtags2($tags2);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       //Validate the Data
        $post = Post::find($id);
        if ($request->input('slug') == $post->slug) {
            $this->validate($request,array(
            'title'=> 'required|max:255',
            'slug'=>'required|alpha_dash|min:5|max:255',
            'category_id'=>'required|numeric',
            'body'=> 'required'
        ));
            
        }else
        {
            $this->validate($request,array(
            'title'=> 'required|max:255',
            'slug'=>'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id'=>'required|numeric',
            'body'=> 'required'
        ));
        }
     
        

        //save Data to database
        
        $post->title = $request->input('title');
        $post->slug= $request->input('slug');
        $post->body = $request->input('body');
        $post->category_id= $request->input('category_id');

        $post->save();
        $post->tags()->sync($request->tags);
        //set flash message with success message
        Session::flash('success', 'this Post was successfully saved!');

        //redirect with flash data to posts.show
        return redirect()->route('posts.show',$post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->tags()->detach();
        $post->delete();
        Session::flash('success', 'the Post Was successfully Deleted!!');
        return redirect()->route('posts.index');
    }
}
