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
        Schema::create('ewallets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('total_panel');
            $table->integer('total_project');
            $table->date('periode')->default(DB::raw('CURRENT_DATE')); // Auto fill tanggal saat ini
            $table->decimal('total_ewallet', 15, 2);
            $table->decimal('panel_bonus', 15, 2);
            $table->decimal('perfomance_bonus', 15, 2);
            $table->timestamps();

            // Foreign keys
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
        Schema::dropIfExists('ewallet');
    }
};
