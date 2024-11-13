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
        Schema::create('assignment_votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submission_id')->constrained('submission_course')->onDelete('cascade');
            $table->foreignId('voter_id')->constrained('users')->onDelete('cascade');
            $table->unsignedTinyInteger('vote_value')->comment('Value between 1 and 10');
            $table->timestamp('vote_date')->useCurrent();
            $table->timestamps();


            $table->unique(['submission_id', 'voter_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignment_votes');
    }
};
