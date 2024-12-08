<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventify - Lista de Eventos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow-md py-4">
        <div class="container mx-auto flex justify-between items-center px-6">
            <a href="/" class="text-2xl font-bold text-gray-700">Eventify</a>
            <nav>
                @if (Route::has('login'))
                    <div class="flex space-x-4">
                        @auth
                            <a href="{{ url('/home') }}" class="text-gray-600 hover:text-gray-900">Home</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-900">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </nav>
        </div>
    </header>

    <main class="container mx-auto mt-10">
        <h1 class="text-3xl font-semibold text-gray-700 text-center mb-6">Lista de Eventos</h1>
        <!-- Tabla para mostrar los eventos -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2">Organizador</th>
                        <th class="px-4 py-2">Título</th>
                        <th class="px-4 py-2">Descripción</th>
                        <th class="px-4 py-2">Categoría</th>
                        <th class="px-4 py-2">Inicio</th>
                        <th class="px-4 py-2">Finalización</th>
                        <th class="px-4 py-2">Precio</th>
                        <th class="px-4 py-2">Imagen</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($events as $event)
                        <tr class="bg-gray-100 border-b">
                            <td class="px-4 py-2">{{ $event->organizer->name }}</td>
                            <td class="px-4 py-2">{{ $event->title }}</td>
                            <td class="px-4 py-2">{{ $event->description }}</td>
                            <td class="px-4 py-2">{{ $event->category->name }}</td>
                            <td class="px-4 py-2">{{ $event->start_time }}</td>
                            <td class="px-4 py-2">{{ $event->end_time }}</td>
                            <td class="px-4 py-2 text-right">${{ number_format($event->price, 2) }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ asset('storage/' .$event->image_url) }}" target="_blank" class="text-blue-500 hover:underline">Ver Imagen</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-gray-500 py-4">No hay eventos disponibles</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
