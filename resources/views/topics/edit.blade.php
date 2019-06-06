
<h1>Editing "{{ $topic->title }}"</h1>

<form action="{{ route('topics.update', $topic->id) }}" method="post">
    {{ csrf_field() }}

    <input type="hidden" name="_method" value="PUT">
    <input type="text" name="title" value="{{ $topic->title }}">
    <button type="submit">Update Topic</button>
</form>

