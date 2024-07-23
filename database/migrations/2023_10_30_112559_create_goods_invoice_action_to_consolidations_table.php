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
        Schema::create('goods_invoice_action_to_consolidations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('goods_invoice_id')->nullable();
            $table->foreign('goods_invoice_id')->references('id')->on('documents');
            $table->unsignedBigInteger('action_id')->nullable();
            $table->foreign('action_id')->references('id')->on('actions_to_consolidations');
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
        Schema::dropIfExists('goods_invoice_action_to_consolidations');
    }
};
