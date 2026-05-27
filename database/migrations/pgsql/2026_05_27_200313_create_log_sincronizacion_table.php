<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'pgsql';

    public function up(): void
    {
        Schema::connection('pgsql')->create('log_sincronizacion', function (Blueprint $table) {
            $table->id('id_log_sincronizacion');
            $table->integer('id_proyecto');
            $table->integer('id_integracion');
            $table->string('tipo', 100)->nullable();
            $table->string('estado', 50)->nullable();
            $table->integer('registros_sincronizacion')->nullable();
            $table->integer('registros_error')->nullable();
            $table->text('detalle_error')->nullable();
            $table->timestamp('fecha_inicio')->nullable();
            $table->timestamp('fecha_fin')->nullable();
        });
    }

    public function down(): void
    {
        Schema::connection('pgsql')->dropIfExists('log_sincronizacion');
    }
};