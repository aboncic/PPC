@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Edit</h1></div>
                    <div class="card-body">
                            <form action="{{ route('topics.update', $topic->id) }}" method="post">
                                {{ csrf_field() }}

                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <input type="text" name="title" class="form-control" id="title" value="{{ $topic->title }}">
                                </div>
                                <div class="form-group">
                                      <div class="row">
                                        <div class="col text-left">
                                          <!-- using a helper to generate a back button -->
                                          <a href="{{ route('topics.index') }}" class="btn btn-primary">Cancel</a>
                                        </div>
                                        <div class="col text-right">
                                          <button type="submit" class="btn btn-success">Edit</button>
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
