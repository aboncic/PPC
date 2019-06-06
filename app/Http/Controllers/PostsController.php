<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as Request;

use App\Post;
use App\Topic;

class PostsController extends Controller
{
    public function __construct(Request $request) {
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

    public function store($topicId) {
        $topic = Topic::find($topicId);
        $input = $this->request->all();
        $input['topic_id'] = $topic->id;
        Post::create($input);

        return redirect()->back();
    }

    public function show($id) {
        $post = Post::findOrFail($post->topic_id);
        return view('topics.show', [
            'post' => $post
        ]);
    }
    public function edit($id) {

        $post = Post::findOrFail($id);
        return view('posts.edit', [
            'post' => $post
        ]);
    }
    public function update($id, Request $request)
        {
          $post = Post::findOrFail($id);

          if (isset($request['description'])) {
            $post->description = $request['description'];
          }
          
          $post->update();

          return redirect('/topics/');
        }

    public function destroy($id) {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect('/topics/' . $id);
    }
}

