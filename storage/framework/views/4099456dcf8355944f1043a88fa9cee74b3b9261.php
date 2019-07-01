<?php $__env->startSection('content'); ?>

<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">

			<div class="card-header"><h1>Edit</h1></div>
		
				<div class="card-body">
					<form action="<?php echo e(route('topics.posts.update', ['id' => $post->id, 'topic_id' => $post->topic_id])); ?>" method="post">
					    <?php echo e(csrf_field()); ?>

					    <div class="form-group purple-border">
						    <input type="hidden" name="_method" value="PUT">

						     <textarea name="description" class="form-control" id="description" rows="3"><?php echo e($post->description); ?></textarea>

					 	</div>
					    <div class="form-group">
                      <div class="row">
                        <div class="col text-left">
                          <!-- using a helper to generate a back button -->
                          <a href="/topics/<?php echo e($post->topic_id); ?>" class="btn btn-primary">Cancel</a>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/adamboncic/Documents/gnome/gumby/resources/views/posts/edit.blade.php ENDPATH**/ ?>