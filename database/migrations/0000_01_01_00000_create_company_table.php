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

        Schema::create('companies', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Basic information
            // $table->string('name');
            $table->string('legal_name')->nullable();
            // $table->string('logo_path')->nullable();
            // $table->string('type');
            // $table->string('invoicing_entity')->nullable();

            // Contact information
            $table->string('primary_email')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('website')->nullable();
            $table->string('phone_1')->nullable();
            $table->string('phone_2')->nullable();

            // Address information
            $table->string('address');
            $table->string('post_code');
            $table->string('city');
            $table->string('district')->nullable();
            $table->string('country');

            // Business information
            $table->string('vat_number')->nullable();

            // Financial information
            $table->string('iban')->nullable();
            $table->string('swift_code')->nullable();

            // Additional fields
            $table->string('status')->default('active');
            $table->string('preferred_language')->default('en');
            $table->text('notes')->nullable();
            $table->string('source')->nullable();

             // Required by Cashier
             $table->string('stripe_id')->nullable();
             $table->string('pm_type')->nullable();
             $table->string('pm_last_four', 4)->nullable();
             $table->timestamp('trial_ends_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};