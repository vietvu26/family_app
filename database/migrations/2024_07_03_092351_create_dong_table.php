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
        Schema::create('dong', function (Blueprint $table) {
        $table->id();
        $table->foreignId('thu_id')->constrained('thu')->onDelete('cascade');
        $table->foreignId('person_id')->constrained('people'); // Tham chiếu đến bảng `people`
        $table->decimal('amount', 15, 2);
        $table->date('payment_date')->nullable();
        $table->text('note')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dong');
    }
};
