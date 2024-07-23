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
        //No other way to change enum column without lost data
        DB::statement("ALTER TABLE doctype_fields MODIFY COLUMN type ENUM('text', 'range', 'select', 'label', 'date', 'dateRange', 'dateTimeRange', 'timeRange', 'switch', 'uploadFile', 'comment')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctype_fields', function (Blueprint $table) {

        });
    }
};
