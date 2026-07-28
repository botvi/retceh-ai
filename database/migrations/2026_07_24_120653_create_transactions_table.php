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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('package_id')->constrained()->onDelete('cascade');
            $table->integer('amount');                    // nominal asli
            $table->integer('total_amount')->nullable();  // total termasuk kode unik QRIS
            $table->enum('status', ['PENDING', 'SUCCESS', 'EXPIRED'])->default('PENDING');
            $table->string('signature')->nullable();      // untuk validasi webhook
            $table->string('qris_url')->nullable();       // URL gambar QR code
            $table->text('qris_image')->nullable();       // base64 gambar QR
            $table->timestamp('expired_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
