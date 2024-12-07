<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventify - Gestión de Eventos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow-md py-4">
        <div class="container mx-auto flex justify-between items-center px-6">
            <a href="/" class="text-2xl font-bold text-gray-700">Eventify</a>
            <nav>
                <?php if(Route::has('login')): ?>
                    <div class="flex space-x-4">
                        <?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(url('/home')); ?>" class="text-gray-600 hover:text-gray-900">Home</a>
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>" class="text-gray-600 hover:text-gray-900">Log in</a>
                            <?php if(Route::has('register')): ?>
                                <a href="<?php echo e(route('register')); ?>" class="text-gray-600 hover:text-gray-900">Register</a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </nav>
        </div>
    </header>
    <main class="container mx-auto mt-10 text-center">
        <h1 class="text-4xl font-semibold text-gray-700">Bienvenido a Eventify</h1>
        <p class="mt-4 text-gray-600">La solución profesional para la gestión de tus eventos.</p>
    </main>
</body>
</html>
<?php /**PATH C:\Users\aleja\Documents\AA_mios\Cursos\DAM\Desarrollo de interfaces\proyecto\Eventify\resources\views/welcome.blade.php ENDPATH**/ ?>