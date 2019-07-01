<?php $__env->startSection('content'); ?>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
              <div class="col text-left">
                <a href="<?php echo e(route('topics.posts.create', ['topic_id' => $topic->id])); ?>" class="add-reply button btn btn-sm btn-primary">Add a Reply</a>
              </div>
              <div class="col text-right">
                        <a href="<?php echo e(route('topics.index')); ?>" class="btn btn-sm btn-primary">Back</a>
              </div>
            </div>

                            <h3><?php echo e($topic->title); ?></h3>

<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php if($topic->id === $post->topic_id): ?>
<div class="card">

  <div class="card-body">
    <div class="form-group">

      <div class="row align-items-center">
        <div class="col-12 col-sm-6 col-md-3 col-lg-2">
                <?php  $name = App\User::where('id', $post['posted_by'])->firstOrFail(); ?>
                <i><b><?php echo e($name->name); ?></b></i>
            <div class="col-12">
                <img src="/storage/avatars/<?php echo e($name->avatar); ?>" class="z-depth-0" alt="avatar" height="50">
            </div>
            <p><?php echo e($post->created_at->diffForHumans()); ?></p>
            <!-- <p class="joined-text">Posts: <?php echo e(App\Post::where('posted_by', $post['posted_by'])->count()); ?></p> -->

          </div>
          <div class="responsive col-12 col-sm-10">

            <h4><?php echo $post->description; ?></h4>
          </div>


        </div>

      </div>

      <div class="panel panel-info" data-id="<?php echo e($post->id); ?>">
        <div class="panel-footer">
              <span class="pull-right">
                  <span class="like-btn">
                      <i id="like<?php echo e($post->id); ?>" class="fa fa-thumbs-up <?php echo e(auth()->user()->hasLiked($post) ? 'like-post' : ''); ?>"></i> <div id="like<?php echo e($post->id); ?>-bs3"><?php echo e($post->likers()->get()->count()); ?></div>
                  </span>
              </span>
          </div>

      </div>


    </div>
            <?php if(auth()->user()->id === $post['posted_by']): ?>
                      <div class="col-12 d-flex justify-content-center box">

                <a href="<?php echo e(route('topics.posts.edit', ['id' => $post->id, 'topic_id' => $topic->id])); ?>" class="edit btn btn-sm btn-primary">&#9998; Edit</a> 
                <form action="/topics/<?php echo e($post->id); ?>/posts/<?php echo e($topic->id); ?>" method="POST">
                                  <?php echo e(csrf_field()); ?>

                                  <?php echo e(method_field('DELETE')); ?>


                <button class="delete btn btn-sm btn-danger" type="submit"> &#128465; Delete</button>
              </form>
                                            


                        </div>

            <?php endif; ?>

  </div>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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






<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/adamboncic/Documents/gnome/gumby/resources/views/topics/show.blade.php ENDPATH**/ ?>