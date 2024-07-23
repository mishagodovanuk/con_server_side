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
        Schema::create('transport_planning_to_consolidations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consolidation_id')->nullable();
            $table->foreign('consolidation_id')->references('id')->on('consolidations');
            $table->unsignedBigInteger('tp_id')->nullable();
            $table->foreign('tp_id')->references('id')->on('transport_plannings');
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
        Schema::dropIfExists('transport_planning_to_consolidations');
    }
};
