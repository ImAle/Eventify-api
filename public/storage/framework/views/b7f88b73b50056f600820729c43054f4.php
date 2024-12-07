<?php $__env->startSection('title', 'Actualizar Evento'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <h1 class="text-center">Actualizar Evento</h1>

    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <!-- Mensajes de Error -->
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Formulario de Actualización de Evento -->
            <form action="<?php echo e(route('events.update', $event->id)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                
                <!-- Categoría del Evento -->
                <div>
                    <label for="category_id">Categoría del Evento</label>
                    <select class="form-control" id="category_id" name="category_id" required>
                        <option value="" disabled <?php echo e(old('category_id', $event->category_id) ? '' : 'selected'); ?>>Selecciona una categoría</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id', $event->category_id) == $category->id ? 'selected' : ''); ?>>
                                <?php echo e($category->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <br>
                
                <!-- Título del Evento -->
                <div class="form-group mb-3">
                    <label for="title">Título del Evento</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Ingresa el título del evento" value="<?php echo e(old('title', $event->title)); ?>" required>
                </div>

                <!-- Fecha y Hora de Inicio -->
                <div class="form-group mb-3">
                    <label for="start_time">Fecha y Hora de Inicio</label>
                    <input type="datetime-local" class="form-control" id="start_time" name="start_time" value="<?php echo e(old('start_time', \Carbon\Carbon::parse($event->start_time)->format('Y-m-d\TH:i'))); ?>" required>
                </div>
                
                <!-- Fecha y Hora de Finalización -->
                <div class="form-group mb-3">
                    <label for="end_time">Fecha y Hora de Finalización</label>
                    <input type="datetime-local" class="form-control" id="end_time" name="end_time" value="<?php echo e(old('end_time', \Carbon\Carbon::parse($event->end_time)->format('Y-m-d\TH:i'))); ?>" required>
                </div>

                <!-- Imagen del Evento -->
                <div class="form-group mb-3">
                    <label for="image">Imagen del Evento</label><br>
                    <input type="file" class="form-control-file" id="image" name="image_url"><br>
                    <small class="form-text text-muted">Deja este campo vacío si no deseas cambiar la imagen.</small>
                </div>

                <!-- Descripción del Evento -->
                <div class="form-group mb-3">
                    <label for="description">Descripción del Evento</label>
                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Describe los detalles del evento"><?php echo e(old('description', $event->description)); ?></textarea>
                </div>

                <!-- Precio del Evento -->
                <div class="form-group mb-3">
                    <label for="price">Precio del Evento</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="Ingresa el precio del evento" value="<?php echo e(old('price', $event->price)); ?>" min="0" step="0.01" required>
                </div>

                <!-- Ubicación -->
                <div class="form-group mb-3">
                    <label for="location">Ubicación</label>
                    <input type="text" class="form-control" id="location" name="location" required value="<?php echo e(old('location', $event->location)); ?>">
                </div>

                <!-- Latitud -->
                <div class="form-group mb-3">
                    <label for="latitude">Latitud</label>
                    <input type="text" class="form-control" id="latitude" name="latitude" required value="<?php echo e(old('latitude', $event->latitude)); ?>">
                </div>

                <!-- Longitud -->
                <div class="form-group mb-3">
                    <label for="longitude">Longitud</label>
                    <input type="text" class="form-control" id="longitude" name="longitude" required value="<?php echo e(old('longitude', $event->longitude)); ?>">
                </div>

                <!-- Máximo de Asistentes -->
                <div class="form-group mb-3">
                    <label for="max_attendees">Máximo de Asistentes</label>
                    <input type="number" class="form-control" id="max_attendees" name="max_attendees" required value="<?php echo e(old('max_attendees', $event->max_attendees)); ?>">
                </div>

                <!-- Botones -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">Actualizar Evento</button>
                    <a href="<?php echo e(route('events.get')); ?>" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aleja\Documents\AA_mios\Cursos\DAM\Desarrollo de interfaces\proyecto\Eventify\resources\views/event/event_update.blade.php ENDPATH**/ ?>