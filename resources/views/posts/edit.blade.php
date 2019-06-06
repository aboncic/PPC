<h1>Editing "{{ $post->description }}"</h1>

<form action="{{ route('topics.update', $post->topic_id) }}" method="post">
    {{ csrf_field() }}

    <input type="hidden" name="_method" value="PUT">
    <input type="text" name="title" value="{{ $post->description }}">
    <button type="submit">Update Description</button>
</form>
