<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions_to_consolidations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consolidation_id')->nullable();
            $table->foreign('consolidation_id')->references('id')->on('consolidations');
            $table->enum('action_type',['download','moving','unloading']);
            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('warehouses');
            $table->date('date');
            $table->time('time_from');
            $table->time('time_to');
            $table->integer('action_number');
            $table->softDeletes();
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
        Schema::dropIfExists('actions_to_consolidations');
    }
};