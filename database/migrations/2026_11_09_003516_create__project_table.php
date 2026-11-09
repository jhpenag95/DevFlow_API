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
        Schema::create('Project', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('fecha_inicio');
            $table->string('fecha_fin');
            $table->string('estado')->default('activo');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); //aqui se establece la relación con la tabla users
            $table->timestamps();
        });
    }

    /**
     * esta función elimina la tabla Project si existe, lo que permite revertir la migración si es necesario.
     */
    public function down(): void
    {
        Schema::dropIfExists('Project');
    }
};
