<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Libro;
use Illuminate\Database\Seeder;

class LibroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $libros = [
            ['id' => '1', 'nombre_libro' => 'El señor de los anillos', 'año' => 1954, 'autor' => 'J.R.R. Tolkien', 'editorial' => 'Allen & Unwin', 'genero' => 'Fantasía', 'disponible' => true],
            ['id' => '2', 'nombre_libro' => 'Harry Potter y la piedra filosofal', 'año' => 1997, 'autor' => 'J.K. Rowling', 'editorial' => 'Bloomsbury', 'genero' => 'Fantasía', 'disponible' => false],
            ['id' => '3', 'nombre_libro' => 'El guardián entre el centeno', 'año' => 1951, 'autor' => 'J.D. Salinger', 'editorial' => 'Little, Brown and Company', 'genero' => 'Ficción', 'disponible' => true],
            ['id' => '4', 'nombre_libro' => 'Fahrenheit 451', 'año' => 1953, 'autor' => 'Ray Bradbury', 'editorial' => 'Ballantine Books', 'genero' => 'Ciencia ficción', 'disponible' => true],
            ['id' => '5', 'nombre_libro' => 'El principito', 'año' => 1943, 'autor' => 'Antoine de Saint-Exupéry', 'editorial' => 'Reynal & Hitchcock', 'genero' => 'Ficción', 'disponible' => false],
            ['id' => '6', 'nombre_libro' => 'Orgullo y prejuicio', 'año' => 1813, 'autor' => 'Jane Austen', 'editorial' => 'T. Egerton', 'genero' => 'Romance', 'disponible' => true],
            ['id' => '7', 'nombre_libro' => 'El gran Gatsby', 'año' => 1925, 'autor' => 'F. Scott Fitzgerald', 'editorial' => 'Charles Scribner\'s Sons', 'genero' => 'Ficción', 'disponible' => true],
            ['id' => '8', 'nombre_libro' => 'Crimen y castigo', 'año' => 1866, 'autor' => 'Fiódor Dostoyevski', 'editorial' => 'The Russian Messenger', 'genero' => 'Ficción', 'disponible' => false],
            ['id' => '9', 'nombre_libro' => 'La metamorfosis', 'año' => 1915, 'autor' => 'Franz Kafka', 'editorial' => 'Kurt Wolff', 'genero' => 'Ficción', 'disponible' => true],
            ['id' => '10', 'nombre_libro' => 'En busca del tiempo perdido', 'año' => 1913, 'autor' => 'Marcel Proust', 'editorial' => 'Grasset', 'genero' => 'Ficción', 'disponible' => false],
        ];

        foreach ($libros as $libro) {
            Libro::create($libro);
        }
    }
}
