@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8" style="font-family: 'Cambria', serif;">
<h1 class="text-xl font-bold mb-6 text-center" style="font-size: 40px; margin-top: 2rem;">Alquiler de Libros</h1>
    <form action="{{ route('dashboard') }}" method="GET" class="mb-8 flex items-center justify-center" style="margin-bottom: 2rem;">
        <input type="text" name="search" placeholder="Buscar libros..." value="{{ request('search') }}" class="border rounded-full px-3 py-2 w-2/3 focus:outline-none mr-2">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700 focus:outline-none">Buscar</button>
    </form>

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 mb-4 rounded">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="bg-red-500 text-white p-3 mb-4 rounded">{{ session('error') }}</div>
    @endif

    <div class="overflow-x-auto mb-8">
        <table class="min-w-full bg-white border-collapse rounded shadow-lg mx-auto">
            <thead>
                <tr style="background-color: #c7e3f4; color: #4a5568;">
                    <th class="px-4 py-2">CÓDIGO</th>
                    <th class="px-4 py-2">NOMBRE</th>
                    <th class="px-4 py-2">AÑO</th>
                    <th class="px-4 py-2">AUTOR</th>
                    <th class="px-4 py-2">EDITORIAL</th>
                    <th class="px-4 py-2">GÉNERO</th>
                    <th class="px-4 py-2">DISPONIBILIDAD</th>
                    <th class="px-4 py-2">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach($libros as $libro)
                    <tr class="text-gray-800 border-t">
                        <td class="border px-4 py-2">{{ $libro->id }}</td>
                        <td class="border px-4 py-2">{{ $libro->nombre_libro }}</td>
                        <td class="border px-4 py-2">{{ $libro->año }}</td>
                        <td class="border px-4 py-2">{{ $libro->autor }}</td>
                        <td class="border px-4 py-2">{{ $libro->editorial }}</td>
                        <td class="border px-4 py-2">{{ $libro->genero }}</td>
                        <td class="border px-4 py-2">
                            @if($libro->disponible)
                                <span class="text-green-600 font-semibold">Disponible</span>
                            @else
                                <span class="text-red-600 font-semibold">No Disponible</span>
                            @endif
                        </td>
                        <td class="border px-4 py-2">
                            @if($libro->disponible)
                                <form action="{{ route('reservar', $libro->id) }}" method="POST" class="flex items-center space-x-2">
                                    @csrf
                                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700 focus:outline-none">Alquilar</button>
                                </form>
                            @else
                                @php
                                    $prestamo = \App\Models\Prestamo::where('id_libro', $libro->id)
                                               ->where('id_usuario', Auth::id())
                                               ->where('estado', 'reservado')
                                               ->first();
                                @endphp
                                @if($prestamo)
                                    <form action="{{ route('devolver.libro', $prestamo->id) }}" method="POST" class="flex items-center space-x-2">
                                        @csrf
                                        <input type="date" name="fecha_devolucion" required class="border rounded-full px-3 py-2 focus:outline-none">
                                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-full hover:bg-green-700 focus:outline-none">Devolver</button>
                                    </form>
                                @else
                                    <span class="text-gray-500">No disponible</span>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if(request('search'))
            <div class="mt-4 text-center">
                <a href="{{ route('dashboard') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none my-4">Volver al listado completo</a>
            </div>
        @endif
    </div>
</div>

<style>
    .bg-blue-500 {
        background-color: #3490dc;
        color: white;
        font-weight: bold;
    }
    .bg-blue-500:hover {
        background-color: #2779bd;
    }
    .bg-green-500 {
        background-color: #38a169;
        color: white;
        font-weight: bold;
    }
    .bg-green-500:hover {
        background-color: #2f855a;
    }
    .rounded {
        border-radius: 0.375rem;
    }
    .rounded-full {
        border-radius: 9999px;
    }
    .text-white {
        color: white;
    }
    .px-4 {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    .py-2 {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
    }
    .space-x-2 > :not([hidden]) ~ :not([hidden]) {
        --tw-space-x-reverse: 0;
        margin-right: calc(0.5rem * var(--tw-space-x-reverse));
        margin-left: calc(0.5rem * calc(1 - var(--tw-space-x-reverse)));
    }
    .mr-2 {
        margin-right: 0.5rem;
    }
</style>
@endsection



