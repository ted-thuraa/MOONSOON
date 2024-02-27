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
        Schema::create('room_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class, 'user_id')->onDelete('cascade');
            $table->string('hostel')->nullable();
            $table->string('roomtype')->nullable();
            $table->boolean('allocated')->default(false);
            $table->timestamp('startdate')->nullable();
            $table->timestamp('enddate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_applications');
    }
};
