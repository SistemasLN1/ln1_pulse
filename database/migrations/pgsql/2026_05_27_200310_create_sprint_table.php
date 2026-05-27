<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'pgsql';

    public function up(): void
    {
        Schema::connection('pgsql')->create('sprint', function (Blueprint $table) {
            $table->id('id_sprint');
            $table->integer('id_proyecto');
            $table->integer('id_usuario');
            $table->string('nombre', 150)->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->string('estado', 50)->nullable();
        });
    }

    public function down(): void
    {
        Schema::connection('pgsql')->dropIfExists('sprint');
    }
};