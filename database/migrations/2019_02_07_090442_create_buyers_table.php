<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('buyer_code')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company')->nullable();
            $table->string('contact_type')->nullable();
            $table->tinyInteger('buyers_premium')->default(0)->comment('0: no, 1: yes');
            $table->integer('buyers_premium_rate')->unsigned()->nullable();
            $table->string('address');
            $table->string('suburb');
            $table->string('state');
            $table->integer('postcode')->unsigned();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->text('comments')->nullable();
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
        Schema::dropIfExists('buyers');
    }
}
