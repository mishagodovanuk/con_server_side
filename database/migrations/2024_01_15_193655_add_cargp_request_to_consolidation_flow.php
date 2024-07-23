<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('transport_request_to_consolidations');
        Schema::dropIfExists('consolidation_to_consolidation');
        Schema::table('transport_plannings', function (Blueprint $table) {
            $table->boolean('consolidation_reserved')->default(0);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
};
