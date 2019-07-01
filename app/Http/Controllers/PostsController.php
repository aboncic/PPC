<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Topic;
use App\User;
use App\Post;
use Illuminate\Http\Request;
use \Response;
use Auth;

class PostsController extends Controller
{
    public function __construct(Request $request) {
        $this->middleware('auth');
        $this->user =  \Auth::user();
        $this->request = $request;
    }

    public function index() {
        $posts = Post::get()->all();
        return view('topics.show', [
            'posts' => $posts
        ]);
    }

    public function create($topicId) {
        return view('posts.create', [
            'topicId' => $topicId
        ]);
    }

    public function store(Request $request, $topicId) {
        $topic = Topic::find($topicId);
        $input = $this->request->all();
        $user = auth()->user();
        $this->validate($request, [
           'description' => 'required',
       ]);

        $dom = new \DomDocument();
        $dom->loadHtml($input['description'], LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach($images as $i => $img)
        {
           $data = $img->getAttribute('src');
           list($type, $data) = explode(';', $data);
           list(, $data)      = explode(',', $data);
           $data = base64_decode($data);
           $image_name= "/upload/" . time().$i.'.png';
           $path = public_path() . $image_name;
           file_put_contents($path, $data);
           $img->removeAttribute('src');
           $img->setAttribute('src', $image_name);
        }

        $input['description'] = $dom->saveHTML();
        $input['posted_by'] = $user->id;
        $input['topic_id'] = $topic->id;
        Post::create($input);

        return redirect()->route('topics.show',['id'=>$topic->id]);
    }

    public function show(Request $request, $id) {
        $post = Post::findOrFail($post->topic_id);
        $user = User::where('id', $post->posted_by)->firstOrFail();
        return view('topics.show')->with(compact('user', 'post'));
    }
    public function edit($id) {

        $post = Post::where('id', $id)->firstOrFail();
        return view('posts.edit')->with(compact('post'));
    }
    public function update($id, Request $request)
        {
          $post = Post::findOrFail($id);

          if (isset($request['description'])) {
            $post->description = $request['description'];
          }

          
          $post->update();

          return redirect('/topics/' . $post->topic_id);
        }

    public function destroy($id) {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect('/topics/' . $post->topic_id);
    }

        public function ajaxRequest(Request $request){


        $post = Post::find($request->id);
        $response = auth()->user()->toggleLike($post);


        return response()->json(['success'=>$response]);
    }
}

