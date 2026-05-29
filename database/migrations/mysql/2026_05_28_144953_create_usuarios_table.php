<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'legacy';

    public function up(): void {
        Schema::connection('legacy')->create('usuarios', function (Blueprint $table) {
            $table->increments('id_usuario');
            $table->string('nombre', 100);
            $table->string('email', 150)->unique();
            $table->string('password');
        });
    }

    public function down(): void {
        Schema::connection('legacy')->dropIfExists('usuarios');
    }
};
