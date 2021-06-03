<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->text('invoice_no');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->string('courier')->nullable();
            $table->string('service')->nullable();
            $table->bigInteger('cost_courier')->nullable();
            $table->integer('total_weight')->nullable();
            $table->string('name');
            $table->bigInteger('phone');
            $table->integer('province')->nullable();
            $table->integer('city')->nullable();
            $table->text('address')->nullable();
            $table->text('shipping_notes')->nullable();
            $table->enum('status', array('pending', 'completed', 'failed', 'paid', 'cancelled'));
            $table->bigInteger('total_order_price');
            $table->bigInteger('discounted_price')->nullable();
            $table->bigInteger('grand_total');
            $table->string('xfers_payment_id')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
