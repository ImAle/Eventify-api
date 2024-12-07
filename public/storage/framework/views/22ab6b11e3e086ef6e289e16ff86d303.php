<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; }
        .title { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background-color: #f4f4f4; }
        img { max-width: 100px; height: auto; }
    </style>
</head>
<body>
    <h1 class="title"><?php echo e($user->name); ?></h1>
    <table>
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Título</th>
                <th>Organizador</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><img src="<?php echo e(public_path('storage/' . $event->image_url)); ?>" alt="Imagen Evento"></td>
                <td><?php echo e($event->title); ?></td>
                <td><?php echo e($event->organizer?->name); ?></td>
                <td><?php echo e(\Carbon\Carbon::parse($event->pivot->registered_at)->format('d/m/Y')); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>
</html>
<?php /**PATH C:\Users\aleja\Documents\AA_mios\Cursos\DAM\Desarrollo de interfaces\proyecto\Eventify\resources\views/informes/events.blade.php ENDPATH**/ ?>