<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',100);
            $table->string('code',50);
            $table->string('icon', 30)->nullable();
            $table->double('discount',8,2)->default(0.00);
            $table->string('discount_type',50)->default(1)->comment('1 => Percentage 2=> Fixed');
            $table->double('max_discount',8,2)->default(0.00);
            $table->string('description')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->tinyInteger('enabled')->default('1');
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
        Schema::dropIfExists('cupons');
    }
}
