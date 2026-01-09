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
        Schema::create('brgy_officials', function (Blueprint $table) {
            $table->id();

            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('suffix')->nullable();

            $table->string('email')->nullable()->unique();
            $table->string('phone_number', 20)->nullable();

            $table->unsignedInteger('age')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('birthplace')->nullable();

            $table->enum('gender', ['male', 'female'])->nullable();
            $table->enum('civil_status', ['single', 'married', 'widowed', 'separated'])->nullable();

            $table->string('photo')->nullable();

            $table->foreignId('purok_id')->nullable()->constrained()->nullOnDelete();

            $table->date('term_start')->nullable();
            $table->date('term_end')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brgy_officials');
    }
};