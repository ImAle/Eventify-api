<?php $__env->startSection('title', 'Mis Eventos'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    <!-- Botón de Crear Nuevo Evento -->
    <?php if(Auth::check() && Auth::user()->role === 'o'): ?>
    <div class="text-center mt-4">
        <a href="<?php echo e(route('events.store')); ?>" class="btn btn-success">Crear Nuevo Evento</a>
    </div>
    <?php endif; ?>

    <?php if(Auth::check() && Auth::user()->role === 'u' && $registered == true): ?>
    <div class="text-center mt-4">
    <a href="<?php echo e(route('events.generateInforme')); ?>" class="btn btn-secondary">Generar Informe</a>
    </div>
    <?php endif; ?>
    


    <!-- Contenedor centrado solo para el mensaje y los eventos -->
    <div class="container mt-5" style="min-height: 50vh;">
        <?php if($events->isEmpty()): ?>
        <p class="text-muted text-center">No hay eventos organizados en este momento.</p>
        <?php else: ?>
        <div class="row mt-4">
            <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 mb-4 d-flex">
                <!-- Tarjeta del evento -->
                <div class="card shadow-sm flex-grow-1">
                    <!-- Imagen del Evento -->
                    <img src="<?php echo e(asset('storage/'.$event->image_url)); ?>" alt="Imagen del evento" class="img-fluid">
                    <div class="card-body">
                        <!-- Título del Evento -->
                        <h5 class="card-title"><?php echo e($event->title); ?></h5>
                        <?php if(Auth::check() && Auth::user()->role === 'u'): ?>
                        <h6 class="text-muted"><?php echo e($event->organizer?->name); ?></h6>
                        <?php endif; ?>

                        <?php if(Auth::check() && Auth::user()->role === 'u' && $registered === true): ?>
                        <?php
                        $userInEvent = $event->users->firstWhere('id', Auth::id());
                        ?>
                        <?php if($userInEvent): ?>
                        <p class="card-text text-muted mb-1">
                            <strong>Fecha de Registro:</strong> <?php echo e(\Carbon\Carbon::parse($userInEvent->pivot->registered_at)->format('d/m/Y')); ?>

                        </p>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Botones fuera de la tarjeta, centrados -->
                <div class="d-flex flex-column align-items-center justify-content-center ms-2">
                    <?php if(Auth::check() && Auth::user()->role === 'u'): ?>
                        <?php if($registered === true): ?>
                        <!-- Botón de borrarse del evento -->
                        <form action="<?php echo e(route('events.deleteFromEvent', $event->id)); ?>" method="POST" class="mb-2">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-danger btn-sm">Borrarse</button>
                        </form>
                        <?php else: ?>
                        <!-- Botón de registrarse en el evento -->
                        <form action="<?php echo e(route('events.register', $event->id)); ?>" method="POST" class="mb-2">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-primary btn-sm">Registrarse</button>
                        </form>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if(Auth::check() && Auth::user()->role === 'o'): ?>
                    <!-- Botón de actualizar -->
                    <a href="<?php echo e(route('events.updateform', $event->id)); ?>" class="btn btn-primary btn-sm mb-2">Actualizar</a>
                    <!-- Botón de borrar -->
                    <form action="<?php echo e(route('events.delete', $event)); ?>" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este evento?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aleja\Documents\AA_mios\Cursos\DAM\Desarrollo de interfaces\proyecto\Eventify\resources\views/event/event_show.blade.php ENDPATH**/ ?>