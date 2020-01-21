<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customer_id')->unsigned();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->integer('writer_id')->nullable();
            $table->string('writer_name')->nullable();
            $table->string('paper_type');
            $table->string('academic_level');
            $table->string('word_spacing');
            $table->integer('pages');
            $table->string('writer_category');
            $table->string('deadline_period');
            $table->string('writer_period');
            $table->string('timezone');
            $table->string('subject');
            $table->string('topic');
            $table->longText('instructions')->nullable();
            $table->string('citation');
            $table->integer('references');
            $table->integer('powerpoint')->nullable();
            $table->integer('charts')->nullable();
            $table->integer('sources')->default(0);
            $table->boolean('samples')->boolean(0);
            $table->boolean('progressive')->default(0);
            $table->boolean('discounted')->default(0);
            $table->string('discount_code')->nullable();
            $table->boolean('redeemed_points')->default(0);
            $table->float('price_amount');
            $table->float('amount_paid')->default(0.00);
            $table->float('writer_amount');
            $table->string('filename')->default(0);
            $table->integer('payment_status')->default(0);
            $table->string('payment_description')->nullable();
            $table->string('rejection_reason')->nullable();
            $table->string('revision_reason')->nullable();
            $table->string('dispute_reason')->nullable();
            $table->longText('comments')->nullable();
            $table->longText('revision')->nullable();
            $table->longText('dispute')->nullable();
            $table->longText('rejection')->nullable();
            $table->integer('bids')->default(0);
            $table->boolean('order_status')->default(0);
            $table->string('payment_id')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
