<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Topic;
use App\User;
use App\Post;
use Illuminate\Http\Request;
use \Response;
use Auth;

class TopicsController extends Controller
{
    public function __construct(Request $request) {
        $this->middleware('auth');
        $this->user =  \Auth::user();
        $this->request = $request;
    }

    public function index() {
        $topics = Topic::orderBy('created_at', 'DESC')->get()->all();

        return view('topics.index', [
            'topics' => $topics
        ]);
    }

    public function create() {
        return view('topics.create', []);
    }

    public function store(Request $request) {
        $this->validate($request, [
           'description' => 'required',
           'title' => 'required',
        ]);
        $input = $request->all();
        $user = auth()->user();
        $input['posted_by'] = $user->id;
        $topic = Topic::create($input);
        $post = Post::create([
        'description' => request('description'),
        'topic_id' => $topic->id,
        'posted_by' => auth()->id()    
    ]);

        return redirect()->route('topics.show',['id'=>$topic->id]);
    }

    public function show(Request $request, $id) {
        $topic = Topic::where('id', $id)->firstOrFail();
        $posts = Post::get()->all();
        
        $user = User::where('id', $topic->posted_by)->firstOrFail();

        return view('topics.show')->with(compact('topic','user', 'posts'));
    }
    public function edit($id) {

        $topic = Topic::findOrFail($id);
        return view('topics.edit', [
            'topic' => $topic
        ]);
    }
    public function update($id, Request $request)
        {

          $this->validate($request, [
                   'title' => 'required',
          ]);

          $topic = Topic::findOrFail($id);

          if (isset($request['title'])) {
            $topic->title = $request['title'];
          }

          $topic->update();

          return redirect('/topics/' . $id);
        }

    public function destroy($id) {
        $topic = Topic::findOrFail($id);
        $topic->delete();
        return redirect()->route('topics.index');
    }

    public function ajaxRequest(Request $request){


        $post = Post::find($request->id);
        $response = auth()->user()->toggleLike($post);


        return response()->json(['success'=>$response]);
    }
}

