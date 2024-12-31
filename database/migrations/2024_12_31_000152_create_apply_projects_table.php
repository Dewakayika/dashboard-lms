<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apply_projects', function (Blueprint $table) {
            $table->id(); // Primary Key

            // Relasi ke tabel projects
            $table->foreignId('project_id')
                ->constrained('projects') // Nama tabel referensi
                ->onDelete('cascade'); // Hapus aplikasi jika project dihapus

            // Relasi ke tabel users
            $table->foreignId('user_id')
                ->constrained('users') // Nama tabel referensi
                ->onDelete('cascade'); // Hapus aplikasi jika user dihapus

            $table->timestamps(); // Created At & Updated At
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apply_projects');
    }
};
