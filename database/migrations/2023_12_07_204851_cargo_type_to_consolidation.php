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
            // Drop foreign key constraint
            $table->dropForeign(['cargo_type_id']);
            // Drop the column
            $table->dropColumn('cargo_type_id');

            $table->text('comment')->nullable()->change();
        });

        Schema::create('cargo_type_to_consolidation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cargo_type_id')->nullable();
            $table->foreign('cargo_type_id')->references('id')->on('cargo_types');
            $table->unsignedBigInteger('consolidation_id')->nullable();
            $table->foreign('consolidation_id')->references('id')->on('consolidations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consolidation', function (Blueprint $table) {
            //
        });
    }
};
