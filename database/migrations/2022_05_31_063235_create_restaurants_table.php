<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->text('description')->default('')->nullable();
            $table->string('address')->nullable();
            $table->string('logo')->nullable();
            $table->string('feature_image')->nullable();
            $table->string('latitude');
            $table->string('longitude');
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->text('information')->nullable();
            $table->double('admin_commission',8,2)->default(0.00)->nullable();
            $table->double('delivery_fee',8,2)->default(0.00)->nullable();
            $table->double('delivery_range',8,2)->default(0.00)->nullable();
            $table->tinyInteger('isPromoted')->default(0)->nullable();
            $table->tinyInteger('isPopular')->default(0)->nullable();
            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();
            $table->tinyInteger('delivery_time')->nullable();
            $table->double('default_tax',8,2)->default(0.00)->nullable();
            $table->tinyInteger('closed')->default(0)->nullable();
            $table->tinyInteger('active')->default(0)->nullable();
            $table->tinyInteger('available_for_delivery')->default(1)->nullable();
            $table->unsignedTinyInteger('state_id');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
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
        Schema::dropIfExists('restaurants');
    }
}
