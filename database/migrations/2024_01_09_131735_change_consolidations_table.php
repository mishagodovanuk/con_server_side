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
        Schema::table('consolidations', function (Blueprint $table) {
            $table->unsignedInteger('weight_available')->change();
            $table->unsignedInteger('weight_booked')->change();
            $table->unsignedSmallInteger('pallets_available')->change();
            $table->unsignedSmallInteger('pallets_booked')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
