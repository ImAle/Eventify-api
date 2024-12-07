<?php $__env->startSection('title', 'Crear Evento'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <h1 class="text-center">Crear un Nuevo Evento</h1>

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

            <!-- Formulario de Creación de Evento -->
            <form action="<?php echo e(route('events.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div>                
                    <label for="category_id">Categoría del Evento</label>
                    <select class="form-control" id="category_id" name="category_id" required>
                        <option value="" disabled selected>Selecciona una categoría</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id') == $category->id ? 'selected' : ''); ?>>
                                <?php echo e($category->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <br>
                <!-- Título del Evento -->
                <div class="form-group mb-3">
                    <label for="title">Título del Evento</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Ingresa el título del evento" value="<?php echo e(old('title')); ?>" required>
                </div>

                <!-- Fecha y Hora -->
                <div class="form-group mb-3">
                    <label for="start_time">Fecha y Hora de Inicio</label>
                    <input type="datetime-local" class="form-control" id="start_time" name="start_time" value="<?php echo e(old('start_time')); ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="end_time">Fecha y Hora de Finalización</label>
                    <input type="datetime-local" class="form-control" id="end_time" name="end_time" value="<?php echo e(old('end_time')); ?>" required>
                </div>

                <!-- Imagen del Evento -->
                <div class="form-group mb-3">
                    <label for="image">Imagen del Evento</label><br>
                    <input type="file" class="form-control-file" id="image" name="image_url">
                </div>

                <!-- Descripción del Evento -->
                <div class="form-group mb-3">
                    <label for="description">Descripción del Evento</label>
                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Describe los detalles del evento"><?php echo e(old('description')); ?></textarea>
                </div>

                <!-- Precio del Evento -->
                <div class="form-group mb-3">
                    <label for="price">Precio del Evento</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="Ingresa el precio del evento" value="<?php echo e(old('price')); ?>" min="0" step="0.01" required>
                </div>
                <!-- Campo para la ubicación -->
                <div class="form-group mb-3">
                    <label for="location">Ubicación</label>
                    <input type="text" class="form-control" id="location" name="location" required value="<?php echo e(old('location')); ?>">
                </div>

                <!-- Campo para la latitud -->
                <div class="form-group mb-3">
                    <label for="latitude">Latitud</label>
                    <input type="text" class="form-control" id="latitude" name="latitude" required value="<?php echo e(old('latitude')); ?>">
                </div>

                <!-- Campo para la longitud -->
                <div class="form-group mb-3">
                    <label for="longitude">Longitud</label>
                    <input type="text" class="form-control" id="longitude" name="longitude" required value="<?php echo e(old('longitude')); ?>">
                </div>

                <!-- Campo para el número asistentes -->
                <div class="form-group mb-3">
                    <label for="max_attendees">Asistentes</label>
                    <input type="number" class="form-control" id="max_attendees" name="max_attendees" required value="<?php echo e(old('max_attendees')); ?>">
                </div>
                
                <!-- Botón de Crear Evento -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">Crear Evento</button>
                    <a href="<?php echo e(route('events.get')); ?>" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aleja\Documents\AA_mios\Cursos\DAM\Desarrollo de interfaces\proyecto\Eventify\resources\views/event/event_create.blade.php ENDPATH**/ ?>