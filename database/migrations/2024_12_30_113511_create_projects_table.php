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
        Schema::create('projects', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('user_id')
            ->reference('id')
            ->on('users')
            ->constrained()
            ->onDelete('cascade');
            $table->string('comic_name');
            $table->integer('chapter_number');
            $table->string('talent_qc');
            $table->string('talent')->nullable();
            $table->integer('number_of_panel')->nullable();
            $table->dateTime('finish_date')->nullable(); // Otomatis saat status "done"
            $table->string('file')->nullable();
            $table->string('status')->default('Waiting Talent');
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
        Schema::dropIfExists('projects');
    }
};
