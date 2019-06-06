
<h1>New Post</h1>

<form action="{{ route('topics.posts.store', ['topic_id' => $topicId]) }}" method="POST">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="text" name="description">
    <button type="submit">Submit</button>
</form>
