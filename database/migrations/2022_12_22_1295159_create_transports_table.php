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
        Schema::create('transports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('transport_brands');
            $table->unsignedBigInteger('model_id');
            $table->foreign('model_id')->references('id')->on('transport_models');
            $table->string('license_plate',8);
            $table->unsignedBigInteger('kind_id');
            $table->foreign('kind_id')->references('id')->on('transport_kinds');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('transport_types');
            $table->float('length')->nullable();
            $table->float('width')->nullable();
            $table->float('height')->nullable();
            $table->float('volume')->nullable();
            $table->float('weight')->nullable();
            $table->float('capacity_eu')->nullable();
            $table->float('capacity_am')->nullable();
            $table->float('spending_empty');
            $table->float('spending_full');
            $table->json('download_methods')->nullable();

            $table->unsignedBigInteger('equipment_id')->nullable();
            $table->foreign('equipment_id')->references('id')->on('additional_equipment');

            $table->unsignedBigInteger('adr_id')->nullable();
            $table->foreign('adr_id')->references('id')->on('adrs');

            $table->integer('manufacture_year');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unsignedBigInteger('driver_id');
            $table->foreign('driver_id')->references('id')->on('users');
            $table->unsignedBigInteger('registration_country_id');
            $table->foreign('registration_country_id')->references('id')->on('countries');
            $table->string('img_type',5)->nullable();

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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('transports');
        Schema::enableForeignKeyConstraints();
    }
};
