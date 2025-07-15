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
        Schema::create('project_tracings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable();
            $table->integer('total_working_time')->default(0); // in seconds
            $table->text('project_report')->nullable();
            $table->string('status')->default('not_started');
            $table->text('pause_reason')->nullable();
            $table->integer('pause_count')->default(0);
            $table->integer('rest_count')->default(0);
            $table->date('date');
            $table->json('pause_logs')->nullable();
            $table->json('rest_logs')->nullable();
            $table->json('session_logs')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_tracings');
    }
};
