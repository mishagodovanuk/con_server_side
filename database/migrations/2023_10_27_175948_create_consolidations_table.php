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
        Schema::create('consolidations', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['uploading','common_ftl','reverse_loading','lg_transport']);
            $table->smallInteger('members');
            $table->smallInteger('pallets_available');
            $table->smallInteger('pallets_booked');
            $table->smallInteger('weight_available');
            $table->smallInteger('weight_booked');
            $table->text('comment');

            $table->unsignedBigInteger('cargo_type_id')->nullable();
            $table->foreign('cargo_type_id')->references('id')->on('cargo_types');

            $table->unsignedBigInteger('reject_id')->nullable();
            $table->foreign('reject_id')->references('id')->on('consolidation_rejects');

            $table->enum('status',['approved','sent','review','draft','unapproved']);

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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('consolidations');
        Schema::enableForeignKeyConstraints();
    }
};
