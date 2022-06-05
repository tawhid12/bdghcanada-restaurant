<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50)->nullable();
            $table->string('username', 50)->unique()->nullable();
            $table->string('email', 100)->unique();
            $table->string('mobileNumber', 20)->unique()->nullable();
            $table->string('timezone')->nullable();
            $table->string('password', 32);
            $table->boolean('status', 1)->default(1)->comment('0 => inactive, 1 => active, 2 => pending, 3 => freez, 4 => block' );
            $table->unsignedTinyInteger('roleId');
            $table->unsignedInteger('userCreatorId')->nullable();
            $table->foreign('roleId')->references('id')->on('roles')->onDelete('cascade');
            $table->index(['name']);
            $table->index(['username']);
            $table->index(['email']);
            $table->index(['mobileNumber']);
            $table->timestamps();
        });

        DB::table('users')->insert([
            [
                'name' => 'Superadmin',
                'username' => 'superadmin',
                'email' => 'superadmin@gmail.com',
                'mobileNumber' => '123456789',
                'password' => md5('superadmin'),
                'status' => 1,
                'roleId' => 1,
                'userCreatorId' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'restaurant Owner',
                'username' => 'owner',
                'email' => 'owner@gmail.com',
                'mobileNumber' => '123456783',
                'password' => md5('owner'),
                'status' => 1,
                'roleId' => 2,
                'userCreatorId' => 6,
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Customer',
                'username' => 'customer',
                'email' => 'customer@gmail.com',
                'mobileNumber' => '123456782',
                'password' => md5('customer'),
                'status' => 1,
                'roleId' => 3,
                'userCreatorId' => 7,
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Delivery Boy',
                'username' => 'delivery',
                'email' => 'delivery@gmail.com',
                'mobileNumber' => '123456781',
                'password' => md5('delivery'),
                'status' => 1,
                'roleId' => 4,
                'userCreatorId' => 7,
                'created_at' => Carbon::now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
