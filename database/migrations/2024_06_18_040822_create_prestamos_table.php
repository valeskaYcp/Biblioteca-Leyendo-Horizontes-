<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_libro')->constrained('libros', 'id')->onDelete('cascade');
            $table->foreignId('id_usuario')->constrained('users', 'id')->onDelete('cascade');
            $table->date('fecha_inicio');
            $table->date('fecha_devolucion')->nullable();
            $table->string('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};
