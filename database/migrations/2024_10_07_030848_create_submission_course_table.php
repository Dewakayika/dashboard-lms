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
        Schema::create('submission_course', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                    ->reference('id')
                    ->on('users')
                    ->constrained()
                    ->onDelete('cascade');
            $table->string('course_name');
            $table->string('chapter_name');
            $table->string('submission_file');
            $table->timestamp('submission_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submission_course');
    }
};
