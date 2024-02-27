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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Hostel::class, 'hostel_id')->onDelete('cascade');
            $table->boolean('available')->default(false);
            $table->string('hostel_name')->nullable();
            $table->string('room_type')->nullable();
            $table->string('room_no')->nullable();
            $table->string('description')->nullable();
            $table->text('thumbnailimage')->nullable();
            $table->unsignedInteger('billing')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
