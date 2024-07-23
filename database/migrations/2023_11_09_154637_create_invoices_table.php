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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_provider_id');
            $table->unsignedBigInteger('company_customer_id');
            $table->unsignedBigInteger('responsible_supply_id');
            $table->unsignedBigInteger('responsible_receive_id');
            $table->unsignedBigInteger('contract_id');
            $table->timestamp('invoice_at')->useCurrent();
            $table->double('sum');
            $table->double('sum_with_pdv');
            $table->timestamp('payment_term');

            $table->foreign('company_provider_id')->references('id')->on('companies');
            $table->foreign('company_customer_id')->references('id')->on('companies');
            $table->foreign('responsible_supply_id')->references('id')->on('companies');
            $table->foreign('responsible_receive_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign(['company_provider_id']);
            $table->dropForeign(['company_customer_id']);
            $table->dropForeign(['responsible_supply_id']);
            $table->dropForeign(['responsible_receive_id']);
        });

        Schema::dropIfExists('invoices');
    }
};
