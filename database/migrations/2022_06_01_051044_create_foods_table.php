<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('restaurant_id')->index();
            $table->bigInteger('user_id');
            $table->string('thumbnail', 30)->nullable();
            $table->unsignedBigInteger('category_id')->index();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('name',255);
            $table->double('price',8,2);
            $table->tinyInteger('discount_type')->default(1)->comment('1=>Fixed, 2=> Percentage')->nullable();
            $table->double('discount_price',8,2)->default(0.00)->nullable();
            $table->text('description')->default('')->nullable();
            $table->double('capacity',9,2)->default(0.00)->nullable();
            $table->double('package_items_count',9,2)->default(0.00)->nullable();
            $table->string('unit')->default(0.00)->nullable();
            $table->tinyInteger('featured')->default(0)->nullable();
            $table->tinyInteger('best_seller')->default(1)->nullable();
            $table->tinyInteger('popular')->default(0)->nullable();
            $table->tinyInteger('deliverable')->default(1)->nullable();
            $table->tinyInteger('status')->default(1)->nullable();
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
        Schema::dropIfExists('foods');
    }
}
