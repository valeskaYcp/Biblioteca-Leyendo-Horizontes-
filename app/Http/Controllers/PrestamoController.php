<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\Prestamo;
use Illuminate\Support\Facades\Auth;

class PrestamoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $libros = Libro::where('nombre_libro', 'LIKE', "%{$search}%")
                    ->orWhere('autor', 'LIKE', "%{$search}%")
                    ->orWhere('editorial', 'LIKE', "%{$search}%")
                    ->get();

        return view('dashboard', compact('libros'));
    }

    public function reservar(Request $request, $id_libro)
    {
        $libro = Libro::findOrFail($id_libro);
    
        if (!$libro->disponible) {
            return redirect()->back()->with('error', 'El libro no está disponible.');
        }
    
        Prestamo::create([
            'id_libro' => $libro->id,
            'id_usuario' => Auth::id(), 
            'fecha_inicio' => now(), 
            'estado' => 'reservado', 
        ]);
    
        $libro->disponible = false;
        $libro->save();
    
        return redirect()->route('dashboard')->with('success', 'Libro reservado con éxito.');
    }
    

    public function devolver(Request $request, $id_prestamo)
    {
        $prestamo = Prestamo::findOrFail($id_prestamo);
    
        if ($prestamo->id_usuario != Auth::id()) {
            return redirect()->back()->with('error', 'No tienes permiso para devolver este libro.');
        }
    
        $request->validate([
            'fecha_devolucion' => 'required|date|after_or_equal:' . now()->toDateString(),
        ], [
            'fecha_devolucion.after_or_equal' => 'La fecha de devolución debe ser igual o posterior a hoy.',
        ]);
    
        $prestamo->fecha_devolucion = $request->input('fecha_devolucion');
        $prestamo->estado = 'devuelto';
        $prestamo->save();
    
        $libro = $prestamo->libro;
        $libro->disponible = true;
        $libro->save();
    
        return redirect()->route('dashboard')->with('success', 'Libro devuelto con éxito.');
    }
    


}