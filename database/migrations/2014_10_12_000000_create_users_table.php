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
        Schema::create('users', function (Blueprint $table) {
            //$table->id();
            $table->id();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->text('image')->nullable();
            $table->string('email')->unique();
            $table->boolean('isAdmin')->default(false)->nullable();
            $table->string('course')->nullable();          
            $table->string('Institution')->nullable();
            $table->string('reg_no')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_phone')->nullable();
            $table->string('guardian_relation')->nullable();
            $table->unsignedInteger('phone_no')->nullable();
            $table->string('emailverification_code')->nullable();
            $table->boolean('is_email_verified')->default(0)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
