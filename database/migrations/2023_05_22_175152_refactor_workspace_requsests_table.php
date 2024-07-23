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
        Schema::table('workspace_requests', function (Blueprint $table) {
            $table->dropForeign(['workspace_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['requested_id']);
        });

        Schema::dropIfExists('workspace_requests');

        Schema::create('company_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedTinyInteger('status')->default(0);
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('workspace_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workspace_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('requested_id');
            $table->unsignedTinyInteger('status')->default(0);
            $table->timestamps();

            $table->foreign('workspace_id')->references('id')->on('workspaces')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('requested_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('company_requests', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('company_requests');
    }
};
