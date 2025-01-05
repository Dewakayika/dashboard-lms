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
        Schema::create('talent', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->reference('id')
                ->on('users')
                ->constrained()
                ->onDelete('cascade');
            $table->string('full_name');
            $table->string('profile_photo');
            $table->string('phone_number');
            $table->string('address');
            $table->string('gender');
            $table->string('date_of_birth');
            $table->string('id_card');
            $table->string('bank_name');
            $table->string('bank_Account');
            $table->string('swift_code');
            $table->string('subjected_tax');
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
        Schema::dropIfExists('talent');
    }
};
