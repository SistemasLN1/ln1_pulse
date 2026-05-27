<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'pgsql';

    public function up(): void
    {
        Schema::connection('pgsql')->create('incidencia', function (Blueprint $table) {
            $table->id('id_incidencia');
            $table->integer('id_proyecto');
            $table->integer('id_usuario');
            $table->integer('id_sprint');
            $table->string('nombre', 255)->nullable();
            $table->text('descripcion')->nullable();
            $table->string('tipo', 100)->nullable();
            $table->string('estado', 100)->nullable();
            $table->integer('puntos_historia')->nullable();
            $table->string('prioridad', 50)->nullable();
            $table->timestamp('fecha_creacion')->nullable();
            $table->timestamp('fecha_cierre')->nullable();

            $table->foreign('id_sprint')
                  ->references('id_sprint')
                  ->on('sprint')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::connection('pgsql')->dropIfExists('incidencia');
    }
};