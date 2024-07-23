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
        Schema::table('sku_by_documents', function (Blueprint $table) {
            $table->dropForeign(['document_id']);
            $table->dropForeign(['goods_id']);
            $table->foreign('document_id')->references('id')->on('documents')->cascadeOnDelete();
            $table->foreign('goods_id')->references('id')->on('goods')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sku_by_documents', function (Blueprint $table) {
            $table->dropForeign(['document_id']);
            $table->dropForeign(['goods_id']);
            $table->foreign('document_id')->references('id')->on('documents');
            $table->foreign('goods_id')->references('id')->on('goods');
        });
    }
};
