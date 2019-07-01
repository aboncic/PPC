<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Edit</h1></div>
                    <div class="card-body">
                            <form action="<?php echo e(route('topics.update', $topic->id)); ?>" method="post">
                                <?php echo e(csrf_field()); ?>


                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <input type="text" name="title" class="form-control" id="title" value="<?php echo e($topic->title); ?>">
                                </div>
                                <div class="form-group">
                                      <div class="row">
                                        <div class="col text-left">
                                          <!-- using a helper to generate a back button -->
                                          <a href="<?php echo e(route('topics.index')); ?>" class="btn btn-primary">Cancel</a>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/adamboncic/Documents/gnome/gumby/resources/views/topics/edit.blade.php ENDPATH**/ ?>