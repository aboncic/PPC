<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Topic;
use App\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $topics = Topic::where('posted_by', $user->id)->orderBy('created_at', 'DESC')->get();
        return view('home')->with(compact('topics'));
    }

}
