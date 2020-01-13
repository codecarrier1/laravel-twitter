<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Laravel\Socialite\Contracts\Provider;
use App\User;
use DB;
//use TwitterStreamingApi;
use Abraham\TwitterOAuth\TwitterOAuth;
//namespace App\Console\Commands;
//use Illuminate\Console\Commands;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public  $twitter;    
    public function __construct()
    {
        $this->twitter = new TwitterOauth(env('TWITTER_CONSUMER_KEY'),env('TWITTER_CONSUMER_SECRET'),env('TWITTER_ACCESS_TOKEN'),env('TWITTER_ACCESS_TOKEN_SECRET'));
        $this->middleware('auth');
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         $user = User::whereProvider("TwitterProvider")
            ->get();
         $profiles = DB::table("profiles")->get();
            $data = array (
                'profiles'=>$profiles,
                 
            );   
         $data = array (
            'users'=>$user,
            'profiles'=>$profiles,
            'author'=>'foo'
        );
        return view('home')->with($data);
        
    }
     public function cProfile($action,Request $request)
    {
     
      $data = array (
                'profile'=>null,
                 
            );
        if($action =="update")
        {
            $id = $request->input("id");
           // return $id;
            $profile =  DB::table("profiles")->where("id", $id)->get()->first();
             $data = array (
                'profile'=>$profile,
                 
            );
              return view('profile_create')->with($data);
        }
        
       return view('profile_create')->with($data);
        
    }
    public function profile($action, Request $request){
        $data = "";
      
            $country = $request->input("country");
            $keyword1 = $request->input("keyword1");
            $keyword2 = $request->input("keyword2");
            $priority = $request->input("spammer");
            if($priority=="priority1")
                $priority = 1;
            else
                $priority = 2;
        if($action == "update")
        {
             
            $id = $request->input("id");
             
            $data=array( "country"=>$country, "keyword1"=>$keyword1, "keyword2"=>$keyword2,'priority'=>$priority);
            //if($name =="")
                DB::table("profiles")->where("id", $id)->delete();
          
                DB::table("profiles")->insert($data);

        }
         if($action == "remove")
        {
             
            $id = $request->input("id");
            DB::table("profiles")->where("id", $id)->delete();

        }
        if($action == "create")
        {
            
            $data = DB::table("profiles")->where("country",$country)->first();
            if(!$data)
            {
                $data=array( "country"=>$country, "keyword1"=>$keyword1, "keyword2"=>$keyword2,'priority'=>$priority);
                DB::table("profiles")->insert($data);
            }
        }

        $profiles = DB::table("profiles")->get();
            $data = array (
                'profiles'=>$profiles,
                 
            );
        return view('profile')->with($data);
    }
    public function view_user(){
        $data = "";

        $users = DB::table("users")->where("provider","TwitterProvider")->get();
            $data = array (
                'users'=>$users,
                 
            );
        return view('users')->with($data);
    } 
    public function view_spammer(){
        $data = "";

        $spammers = DB::table("spammers")->get();
            $data = array (
                'spammers'=>$spammers,
                 
            );
        return view('spammers')->with($data);
    }
     
    public function DetectBot(Request $request){
       $country = $request->input("country");
     
       $weid = $request->input("id");
       $profiles1 = DB::table("profiles")->where("country",$country)->get()->first();
       $spammers = DB::table("spammers")->get();
       
        
        
       //q=#hashtag1+OR+#hashtag2
     
      
      //$status = json_encode($status);
           $data1 = array (
                'profiles'=>$profiles1 , 'spammers'=>$spammers
                 
            );   
        return $data1;
      // return env('TWITTER_CONSUMER_KEY');https://api.twitter.com/1.1/search/tweets.json
        // TwitterStreamingApi::publicStream()
        //     ->whenHears('a', function (array $tweet) {
        //                 //        dump("{$tweet['user']['screen_name']} tweeted {$tweet['text']}");
        //         echo "a";

        //         //dump("{$tweet['user']['screen_name']} tweeted {$tweet['text']}");
        //     })
        //     ->startListening();
    }
}
