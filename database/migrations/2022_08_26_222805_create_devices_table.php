<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('model');
            $table->string('brand');
            $table->string('release_date')->nullable();
            $table->string('os')->nullable();
            $table->boolean('is_new')->default(0);
            $table->string('received_datetime',6)->nullable();
            $table->timestamp('created_datetime')->useCurrent();
            $table->timestamp('update_datetime')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices');
    }
}
