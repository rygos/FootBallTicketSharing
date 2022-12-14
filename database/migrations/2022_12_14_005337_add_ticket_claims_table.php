<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_claims', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('match_id');
            $table->integer('ticket_id');
            $table->integer('claimed_by_id')->nullable();
            $table->integer('claim_confirmend')->nullable();
            $table->dateTime('claim_confirmed_at')->nullable();
            $table->integer('payment_confirmed')->nullable();
            $table->dateTime('payment_confirmed_at')->nullable();
            $table->integer('payment_confirmed_by_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_claims');
    }
};
