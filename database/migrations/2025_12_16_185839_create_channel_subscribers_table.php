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
        Schema::create('channel_subscribers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('channel_id')->nullable();
            $table->foreign('channel_id')->references('id')->on('channels')->onDelete('cascade');
            $table->uuid('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->timestamp('joined_at')->nullable();
            $table->string('status')->default('inactive');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('channel_subscribers');
    }
};
