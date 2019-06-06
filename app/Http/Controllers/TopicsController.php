<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as Request;

use App\Topic;
use App\Post;

class TopicsController extends Controller
{
    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function index() {
        $topics = Topic::get()->all();
        return view('topics.index', [
            'topics' => $topics
        ]);
    }

    public function create() {
        return view('topics.create', []);
    }

    public function store() {
        $title = $this->request->input('title');
        $topic = Topic::create([
            'title' => $title
        ]);
        return redirect()->route('topics.show',['id'=>$topic->id]);
    }

    public function show($id) {
        $topic = Topic::findOrFail($id);
        $posts = Post::get()->all();

        return view('topics.show', [
            'topic' => $topic,
            'posts' => $posts
        ]);
    }
    public function edit($id) {

        $topic = Topic::findOrFail($id);
        return view('topics.edit', [
            'topic' => $topic
        ]);
    }
    public function update($id, Request $request)
        {
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
}

