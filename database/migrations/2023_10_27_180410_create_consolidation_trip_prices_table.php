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
        Schema::create('consolidation_trip_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consolidation_id')->nullable();
            $table->foreign('consolidation_id')->references('id')->on('consolidations');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->integer('old_price');
            $table->integer('new_price');
            $table->smallInteger('currency');
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
        Schema::dropIfExists('consolidation_trip_prices');
    }
};
