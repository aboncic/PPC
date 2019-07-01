@extends('layouts.app')

@section('content')

<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">

			<div class="card-header"><h1>Edit</h1></div>
		
				<div class="card-body">
					<form action="{{ route('topics.posts.update', ['id' => $post->id, 'topic_id' => $post->topic_id]) }}" method="post">
					    {{ csrf_field() }}
					    <div class="form-group purple-border">
						    <input type="hidden" name="_method" value="PUT">

						     <textarea name="description" class="form-control" id="description" rows="3">{{ $post->description }}</textarea>

					 	</div>
					    <div class="form-group">
                      <div class="row">
                        <div class="col text-left">
                          <!-- using a helper to generate a back button -->
                          <a href="/topics/{{$post->topic_id}}" class="btn btn-primary">Cancel</a>
                        </div>
                        <div class="col text-right">
                          <button type="submit" class="btn btn-success">Edit</button>
                        </div>
                      </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
