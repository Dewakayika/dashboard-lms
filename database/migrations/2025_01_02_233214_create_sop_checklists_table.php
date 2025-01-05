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
        Schema::create('sop_checklists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sop_id')->references('id')->on('sops')->onDelete('cascade'); // Relasi ke tabel sops
            $table->foreignId('project_id')->references('id')->on('projects')->onDelete('cascade');// Relasi ke tabel projects
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade'); // Relasi ke tabel users
            $table->boolean('is_checked')->default(false); // Status checklist
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     *php artisan make:model SopChecklist

     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sop_checklists');
    }
};
