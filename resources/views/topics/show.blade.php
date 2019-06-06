
<h1>Show Topic</h1>

    <h3>{{$topic->title}}</h3>
    <a href="{{ route('topics.edit', $topic->id) }}" class="btn btn-primary">Edit Topic</a>
    
    <form action="/topics/{{ $topic->id }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}

        <button>Delete</button>
    </form>

    <a href="{{ route('topics.posts.create', ['topic_id' => $topic->id]) }}">New Post</a>


<a href="/topics">Back</a>


@foreach ($posts as $post)
@if ($topic->id === $post->topic_id)
        <h4>{{$post->description}}</h4>
@endif
@endforeach