<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use Mail;
use Session;
class pagesController extends Controller
{
   public function getIndex()
   {
    $posts= Post::orderBy('created_at','desc')->limit(4)->get();
    return view("pages.welcome")->withposts($posts);
   }
   public function getAbout(){
   	$first ="medo";
   	$sec="omar";
   	$full=$first." ".$sec;
   	$email='medo@medo.com';
   	return view("pages.about")->withfull($full)->withemail($email);

   }

   public function getContact(){

   	return view('pages.contact');


   }

   public function postContact(Request $request){
     $this->validate($request,[
      'email'=>'required|email',
      'subject'=>'required|min:5',
      'message'=>'required|min:10'


      ]);
     $data=array(
      'email'=> $request->email,
      'subject'=>$request->subject,
      'mess' =>$request->message,
      'survay'=> ['Q1'=> "hello",'Q2'=>"yes"]
   );
     Mail::send('emails.contact',$data, function($mess2) use ($data){
      $mess2->from($data['email']);
      $mess2->to('abdoulrahmano@stud.fci-cu.edu.eg');
      $mess2->subject($data['subject']);


     });
     Session::flash('success','Your Email Was Sent!!');
     return redirect();
    
   }
   
}
