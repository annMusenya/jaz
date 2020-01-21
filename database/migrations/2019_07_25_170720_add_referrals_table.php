<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referrals', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('customer_id');
          $table->string('customer_name');
          $table->integer('referrals');
          $table->integer('conversion_rate');
          $table->integer('cash_equivalent');
          $table->integer('amount_redeemed');
          $table->longText('description');
          $table->boolean('status')->default(0);
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
        Schema::dropIfExists('referrals');
    }
}
