<?php $__env->startSection('content'); ?>
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex"><h3>My Posts</h3> <span class="ml-auto "><a class="btn btn-primary btn-xs" href="topics/create">New</a></span></div>

                <div class="card-body">
                    <?php if(count($topics) != 0): ?>
                      <div class="container-fluid">
                        <?php $__currentLoopData = $topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row align-items-center">
                          <div class="col-8">
                                <a href="topics/<?php echo e($topic->id); ?>">
                                  <h5><?php echo e($topic->title); ?></h5>
                              </a>
                               <p><?php echo e($topic->created_at->diffForHumans()); ?></p>

                          </div>
                          <div class="col-4 d-flex justify-content-end">

                                <?php if(auth()->user()->id === $topic['posted_by']): ?>
                                  <a href="<?php echo e(route('topics.edit', $topic->id)); ?>" class="btn btn-sm btn-primary">&#9998;</a>
                              
                              <form action="/topics/<?php echo e($topic->id); ?>" method="POST">
                                  <?php echo e(csrf_field()); ?>

                                  <?php echo e(method_field('DELETE')); ?>


                                  <button class="btn btn-sm btn-danger" type="submit">&#9587;</button>
                              </form>

                              <?php endif; ?>

                          </div>
                        </div>
                        <hr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </div>
                    <?php else: ?>
                    <p>You have not written any posts. <a class="btn btn-primary btn-xs" href="topics/create">Get started!</a></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/adamboncic/Documents/gnome/gumby/resources/views/home.blade.php ENDPATH**/ ?>