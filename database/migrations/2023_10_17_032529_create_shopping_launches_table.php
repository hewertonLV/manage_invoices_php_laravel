<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shopping_launches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('buyer_id');
            $table->unsignedBigInteger('card_id');
            $table->unsignedBigInteger('category_id');
            $table->float('value');
            $table->float('first_value_installment');
            $table->float('value_installments');
            $table->date('date_shopping');
            $table->date('date_first_installment');
            $table->date('date_last_installment');
            $table->integer('installmentsNumber');
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('buyer_id')->references('id')->on('buyers');
            $table->foreign('card_id')->references('id')->on('cards');
            $table->foreign('category_id')->references('id')->on('category_shoppings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopping_launches');
    }
};
