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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::table('users', function (Blueprint $table) {
            // Drop the 'key_pass_card' column
            $table->dropColumn('key_pass_card');

            // Drop foreign key constraints and corresponding indexes
            $table->dropForeign(['unit_id']);
            $table->dropIndex('users_unit_id_foreign');

            $table->dropForeign(['brigade_id']);
            $table->dropIndex('users_brigade_id_foreign');

            // Drop the 'unit_id' and 'brigade_id' columns
            $table->dropColumn(['unit_id', 'brigade_id']);

            $table->boolean('sex')->after('email')->nullable();
        });

        Schema::dropIfExists('brigades');

        Schema::dropIfExists('units');

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

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
