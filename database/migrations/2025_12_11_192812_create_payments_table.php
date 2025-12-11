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
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->decimal('amount', 8, 2);
            $table->string('payment_method')->nullable();
            $table->date('payment_date');
            $table->string('status')->default('paid'); // paid / pending
            $table->timestamps();
            $table->softDeletes();

            $table->uuid('memberId');
            $table->foreign('memberId')->references('id')->on('members')->onDelete('restrict');

            $table->uuid('subscriptionId');
            $table->foreign('subscriptionId')->references('id')->on('subscriptions')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
