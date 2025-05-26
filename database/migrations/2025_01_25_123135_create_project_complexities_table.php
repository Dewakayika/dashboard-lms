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
        Schema::create('project_complexities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained();
            $table->string('comic_name');
            $table->foreignId('user_id')->constrained();
            $table->tinyInteger('complexity')->comment('1=Very Easy, 2=Easy, 3=Medium, 4=Hard, 5=Very Hard');
            $table->timestamps();

            // Prevent duplicate entries for the same project and user
            $table->unique(['project_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_complexities');
    }
};
