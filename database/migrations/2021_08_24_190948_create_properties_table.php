<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->unsignedBigInteger('household_id')->nullable();
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->boolean('tenant_status')->default(false);
            $table->enum('purpose',array('lease','residence'))->default('residence');
            $table->string('price');
            $table->dateTime('paid_at')->default(NULL)->nullable();
            $table->timestamps();
            $table->foreign('household_id')->references('id')->on('users');
            $table->foreign('tenant_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
