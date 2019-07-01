@extends('layouts.app')

@section('content')

<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header"><h1>New Post</h1></div>
				@if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
				<div class="card-body">

						<form action="{{ route('topics.posts.store', ['topic_id' => $topicId]) }}" method="POST">
						    <input type="hidden" name="_token" value="{{csrf_token()}}">
						   	<div class="form-group">
						    	<textarea name="description" class="form-control summernote" id="description" rows="3"></textarea>
						</div>
						<div class="form-group">
	                      <div class="row">
	                        <div class="col text-left">
	                          <!-- using a helper to generate a back button -->
	                          <a href="/topics/{{$topicId}}" class="btn btn-primary">Cancel</a>
	                        </div>
	                        <div class="col text-right">
	                          <button type="submit" class="btn btn-success">Submit</button>
	                        </div>
	                      </div>
	                    </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
