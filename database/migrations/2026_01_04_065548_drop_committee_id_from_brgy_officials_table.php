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
        Schema::table('brgy_officials', function (Blueprint $table) {
            if (Schema::hasColumn('brgy_officials', 'committee_id')) {
                $table->dropColumn('committee_id'); // just drop the column
            }
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('brgy_officials', function (Blueprint $table) {
            $table->foreignId('committee_id')
                  ->nullable()
                  ->constrained('committee_position')
                  ->nullOnDelete()
                  ->after('term_end');
        });
    }
};