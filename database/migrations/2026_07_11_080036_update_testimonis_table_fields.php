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
        Schema::table('testimonis', function (Blueprint $table) {
            $table->string('name')->nullable()->after('user_id');
            $table->string('role')->nullable()->after('name');
            $table->integer('rating')->default(5)->after('role');
            $table->string('status')->default('approved')->after('pesan'); // 'pending', 'approved', 'rejected'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonis', function (Blueprint $table) {
            $table->dropColumn(['name', 'role', 'rating', 'status']);
        });
    }
};
