<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'legacy';

    public function up(): void
    {
        Schema::connection('legacy')->create('rol', function (Blueprint $table) {
            $table->increments('id_rol');
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
        });
    }

    public function down(): void
    {
        Schema::connection('legacy')->dropIfExists('rol');
    }
};