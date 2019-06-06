
<h1>New Topic</h1>

<form action="/topics" method="post">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="text" name="title">
    <button type="submit">Submit</button>
</form>

