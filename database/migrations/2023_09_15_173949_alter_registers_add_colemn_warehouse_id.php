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
        Schema::table('registers', function (Blueprint $table) {
            $table->unsignedBigInteger('warehouse_id');
            $table->unsignedBigInteger('transport_planning_id')->nullable();

            $table->foreign('warehouse_id')->references('id')->on('warehouses')->cascadeOnDelete();
            $table->foreign('transport_planning_id')->references('id')->on('transport_plannings')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registers', function (Blueprint $table) {
            $table->dropForeign(['warehouse_id']);
            $table->dropForeign(['transport_planning_id']);
            $table->dropColumn('warehouse_id');
            $table->dropColumn('transport_planning_id');
        });
    }
};
