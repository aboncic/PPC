@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex"><h3>My Posts</h3> <span class="ml-auto "><a class="btn btn-primary btn-xs" href="topics/create">New</a></span></div>

                <div class="card-body">
                    @if (count($topics) != 0)
                      <div class="container-fluid">
                        @foreach ($topics as $topic)
                        <div class="row align-items-center">
                          <div class="col-8">
                                <a href="topics/{{$topic->id}}">
                                  <h5>{{$topic->title}}</h5>
                              </a>
                               <p>{{ $topic->created_at->diffForHumans()}}</p>

                          </div>
                          <div class="col-4 d-flex justify-content-end">

                                @if (auth()->user()->id === $topic['posted_by'])
                                  <a href="{{ route('topics.edit', $topic->id) }}" class="btn btn-sm btn-primary">&#9998;</a>
                              
                              <form action="/topics/{{ $topic->id }}" method="POST">
                                  {{ csrf_field() }}
                                  {{ method_field('DELETE') }}

                                  <button class="btn btn-sm btn-danger" type="submit">&#9587;</button>
                              </form>

                              @endif

                          </div>
                        </div>
                        <hr>
                        @endforeach
                      </div>
                    @else
                    <p>You have not written any posts. <a class="btn btn-primary btn-xs" href="topics/create">Get started!</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

