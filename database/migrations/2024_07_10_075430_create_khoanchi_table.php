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
        Schema::create('khoanchi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('thu_id')->constrained('thu')->onDelete('cascade');
            $table->foreignId('chi_id')->constrained('chi')->onDelete('cascade');
            $table->string('name');
            $table->decimal('amount', 15, 2);
            $table->date('payment_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_khoanchi');
    }
};
