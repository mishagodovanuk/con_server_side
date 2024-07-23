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
        Schema::create('transport_planing', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('creator_id');
            $table->unsignedBigInteger('company_provider_id');
            $table->unsignedBigInteger('company_carrier_id');
            $table->unsignedBigInteger('transport_id');
            $table->unsignedBigInteger('additional_equipment_id');
            $table->unsignedBigInteger('payer_id');
            $table->unsignedBigInteger('driver_id');

            $table->double('price')->default(0);
            $table->boolean('with_pdv')->default(0);
            $table->unsignedTinyInteger('status')->default(0);
            $table->timestamps();

            $table->foreign('creator_id')->references('id')->on('users');
            $table->foreign('company_provider_id')->references('id')->on('companies');
            $table->foreign('company_carrier_id')->references('id')->on('companies');
            $table->foreign('transport_id')->references('id')->on('transports');
            $table->foreign('additional_equipment_id')->references('id')->on('additional_equipment');
            $table->foreign('payer_id')->references('id')->on('companies');
            $table->foreign('driver_id')->references('id')->on('users');
        });

        Schema::create('transport_planing_documents', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('transport_planing_id');
            $table->unsignedBigInteger('document_id');

            $table->timestamp('download_start')->useCurrent();
            $table->timestamp('download_end')->useCurrent();

            $table->timestamp('unloading_start')->useCurrent();
            $table->timestamp('unloading_end')->useCurrent();

            $table->foreign('transport_planing_id')->references('id')->on('transport_planing');
            $table->foreign('document_id')->references('id')->on('documents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transport_planing_documents', function (Blueprint $table) {
            $table->dropForeign(['transport_planing_id']);
            $table->dropForeign(['document_id']);
        });

        Schema::dropIfExists('transport_planing_documents');

        Schema::table('transport_planing', function (Blueprint $table) {
            $table->dropForeign(['creator_id']);
            $table->dropForeign(['company_provider_id']);
            $table->dropForeign(['company_carrier_id']);
            $table->dropForeign(['transport_id']);
            $table->dropForeign(['additional_equipment_id']);
            $table->dropForeign(['payer_id']);
            $table->dropForeign(['driver_id']);
        });

        Schema::dropIfExists('transport_planing');
    }
};
