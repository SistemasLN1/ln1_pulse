<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'pgsql';

    public function up(): void
    {
        Schema::connection('pgsql')->create('sprint_metrica', function (Blueprint $table) {
            $table->id('id_sprint_metrica');
            $table->integer('id_sprint');
            $table->integer('id_proyecto');
            $table->integer('puntos_completado')->nullable();
            $table->integer('puntos_totales')->nullable();
            $table->float('velocidad')->nullable();
            $table->float('porcentaje_completado')->nullable();
            $table->date('fecha_registro')->nullable();

            $table->foreign('id_sprint')
                  ->references('id_sprint')
                  ->on('sprint')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::connection('pgsql')->dropIfExists('sprint_metrica');
    }
};