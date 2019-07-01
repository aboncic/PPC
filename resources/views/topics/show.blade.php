@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
              <div class="col text-left">
                <a href="{{ route('topics.posts.create', ['topic_id' => $topic->id]) }}" class="add-reply button btn btn-sm btn-primary">Add a Reply</a>
              </div>
              <div class="col text-right">
                        <a href="{{ route('topics.index') }}" class="btn btn-sm btn-primary">Back</a>
              </div>
            </div>

                            <h3>{{ $topic->title }}</h3>

@foreach ($posts as $post)

@if ($topic->id === $post->topic_id)
<div class="card">

  <div class="card-body">
    <div class="form-group">

      <div class="row align-items-center">
        <div class="col-12 col-sm-6 col-md-3 col-lg-2">
                <?php  $name = App\User::where('id', $post['posted_by'])->firstOrFail(); ?>
                <i><b>{{ $name->name }}</b></i>
            <div class="col-12">
                <img src="/storage/avatars/{{ $name->avatar }}" class="z-depth-0" alt="avatar" height="50">
            </div>
            <p>{{ $post->created_at->diffForHumans()}}</p>
            <!-- <p class="joined-text">Posts: {{ App\Post::where('posted_by', $post['posted_by'])->count() }}</p> -->

          </div>
          <div class="responsive col-12 col-sm-10">

            <h4>{!! $post->description !!}</h4>
          </div>


        </div>

      </div>

      <div class="panel panel-info" data-id="{{ $post->id }}">
        <div class="panel-footer">
              <span class="pull-right">
                  <span class="like-btn">
                      <i id="like{{$post->id}}" class="fa fa-thumbs-up {{ auth()->user()->hasLiked($post) ? 'like-post' : '' }}"></i> <div id="like{{$post->id}}-bs3">{{ $post->likers()->get()->count() }}</div>
                  </span>
              </span>
          </div>

      </div>


    </div>
            @if (auth()->user()->id === $post['posted_by'])
                      <div class="col-12 d-flex justify-content-center box">

                <a href="{{ route('topics.posts.edit', ['id' => $post->id, 'topic_id' => $topic->id]) }}" class="edit btn btn-sm btn-primary">&#9998; Edit</a> 
                <form action="/topics/{{ $post->id }}/posts/{{ $topic->id }}" method="POST">
                                  {{ csrf_field() }}
                                  {{ method_field('DELETE') }}

                <button class="delete btn btn-sm btn-danger" type="submit"> &#128465; Delete</button>
              </form>
                                            


                        </div>

            @endif

  </div>
@endif
@endforeach
        </div>

    </div>

</div>

<script type="text/javascript">
    $(document).ready(function() {     


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('i.fa-thumbs-up, i.fa-thumbs-down').click(function(){    
            var id = $(this).parents(".panel").data('id');
            var c = $('#'+this.id+'-bs3').html();
            var cObjId = this.id;
            var cObj = $(this);


            $.ajax({
               type:'POST',
               url:'/ajaxRequest',
               data:{id:id},
               success:function(data){
                  if(jQuery.isEmptyObject(data.success.attached)){
                    $('#'+cObjId+'-bs3').html(parseInt(c)-1);
                    $(cObj).removeClass("like-post");
                  }else{
                    $('#'+cObjId+'-bs3').html(parseInt(c)+1);
                    $(cObj).addClass("like-post");
                  }
               }
            });


        });      


        $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });                                        
    }); 
</script>






@endsection