
<h1>Topics</h1>

    @foreach ($topics as $topic)
    <a href="topics/{{$topic->id}}">
        <h3>{{$topic->title}}</h3>
    </a>
    @endforeach

<a href="/topics/create">New Topic</a>

