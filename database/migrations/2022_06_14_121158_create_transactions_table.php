<?php

use Illuminate\Support\Facades\Schema;
use Sajjadmgd\Zarinpal\Facades\Payment;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('amount');
            $table->string('description');
            $table->string('authority')->unique();
            $table->string('ref_id')->nullable()->unique();
            $table->string('start_pay')->unique();
            $table->string('transactionable_type');
            $table->unsignedBigInteger('transactionable_id');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('status', Payment::TransctionStatuses);
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('canceled_at')->nullable();
            $table->timestamp('expire_in')->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
