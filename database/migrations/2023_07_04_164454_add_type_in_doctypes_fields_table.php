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
        Schema::table('doctypes_fields', function (Blueprint $table) {
            DB::statement("ALTER TABLE doctype_fields MODIFY COLUMN type ENUM('text', 'range', 'select', 'label', 'date', 'dateRange', 'dateTimeRange', 'timeRange', 'switch', 'uploadFile', 'comment','dateTime')");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctypes_fields', function (Blueprint $table) {
            //
        });
    }
};
