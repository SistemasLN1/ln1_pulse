<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'mysql';

    public function up(): void
    {
        Schema::connection('mysql')->create('permiso', function (Blueprint $table) {
            $table->increments('id_permiso');
            $table->string('nombre', 100);
            $table->string('modulo', 100)->nullable();
        });
    }

    public function down(): void
    {
        Schema::connection('mysql')->dropIfExists('permiso');
    }
};