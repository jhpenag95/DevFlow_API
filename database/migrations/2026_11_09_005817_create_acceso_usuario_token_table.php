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
        Schema::create('acceso_usuario_token', function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable'); //tokenable: Este método crea dos columnas: tokenable_id y tokenable_type. Estas columnas se utilizan para almacenar la relación polimórfica entre el modelo que tiene el token y el modelo de token en sí. Por ejemplo, si un usuario tiene un token, tokenable_id almacenará el ID del usuario y tokenable_type almacenará el nombre de la clase del modelo de usuario.Esto para que puedas tener diferentes tipos de modelos que puedan tener tokens asociados, como usuarios, administradores, etc.
            $table->text('nombre');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable(); //abilities: Esta columna se utiliza para almacenar las habilidades o permisos asociados con el token. Puede ser una lista de habilidades separadas por comas o un formato JSON que describa los permisos del token. Esto permite que el token tenga diferentes niveles de acceso según las necesidades de la aplicación.
            $table->timestamp('last_used_at')->nullable(); //last_used_at: Esta columna se utiliza para almacenar la fecha y hora en que el token fue utilizado por última vez.
            $table->timestamp('expires_at')->nullable(); //expires_at: Esta columna se utiliza para almacenar la fecha y hora en que el token expirará. Esto permite establecer un período de validez para el token, después del cual ya no será válido. Es útil para implementar políticas de seguridad y control de acceso, ya que los tokens caducados no podrán ser utilizados para acceder a recursos protegidos.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acceso_usuario_token');
    }
};
