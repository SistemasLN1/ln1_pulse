<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'legacy';

    public function up(): void
    {
        Schema::connection('legacy')->create('usuario_rol', function (Blueprint $table) {
            $table->increments('id_usuario_rol');
            $table->unsignedInteger('id_usuario');
            $table->unsignedInteger('id_rol');

            $table->foreign('id_usuario')
                  ->references('id_usuario')->on('usuarios')
                  ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('id_rol')
                  ->references('id_rol')->on('rol')
                  ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::connection('legacy')->dropIfExists('usuario_rol');
    }
};