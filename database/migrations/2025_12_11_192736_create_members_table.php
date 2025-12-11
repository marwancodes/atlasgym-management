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
        Schema::create('members', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->date('join_date')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
            $table->softDeletes();


            $table->uuid('userId');
            $table->foreign('userId')->references('id')->on('users')->onDelete('restrict');

            $table->uuid('trainerId');
            $table->foreign('trainerId')->references('id')->on('trainers')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
