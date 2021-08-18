<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBootcampApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bootcamp_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('gender');
            $table->string('phone_no');
            $table->unsignedBigInteger('province_id');
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->text('address');
            $table->string('last_degree');
            $table->string('institution');
            $table->string('batch');
            $table->text('sumber_tahu_program')->nullable();
            $table->string('mencari_kerja');
            $table->text('social_media');
            $table->string('konsiderasi_lanjut');
            $table->text('kenapa_memilih')->nullable();
            $table->text('expectation');
            $table->string('promo_code')->nullable();
            $table->text('metode_pembayaran_bootcamp');
            $table->string('bankShortCode')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->boolean('is_trial')->nullable();
            $table->boolean('is_full_registration')->nullable();
            $table->enum('status', ['ft_pending', 'ft_paid', 'ft_refunded', 'ft_cancelled','waiting','approved','denied'])->nullable();
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
        Schema::dropIfExists('bootcamp_applications');
    }
}
