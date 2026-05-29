<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'legacy';

    public function up(): void
    {
        Schema::connection('legacy')->create('rol_permiso', function (Blueprint $table) {
            $table->increments('id_rol_permiso');
            $table->unsignedInteger('id_rol');
            $table->unsignedInteger('id_permiso');

            $table->foreign('id_rol')
                  ->references('id_rol')->on('rol')
                  ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('id_permiso')
                  ->references('id_permiso')->on('permiso')
                  ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::connection('legacy')->dropIfExists('rol_permiso');
    }
};