<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>New Topic</h1></div>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <div class="card-body">
                    <form action="/topics" method="post">
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                        <div class ="form-group">
                        <input type="text" name="title" class="form-control" id="title" placeholder="Write your discussion title">
                          <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                        </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col text-left">
                          <!-- using a helper to generate a back button -->
                          <a href="<?php echo e(route('topics.index')); ?>" class="btn btn-primary">Cancel</a>
                        </div>
                        <div class="col text-right">
                          <button type="submit" class="btn btn-success">Post Discussion</button>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/adamboncic/Documents/gnome/gumby/resources/views/topics/create.blade.php ENDPATH**/ ?>