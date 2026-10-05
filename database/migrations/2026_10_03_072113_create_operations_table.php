<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->string('operation_code')->unique();
            // Foreign keys linking to personnel and logistics items[cite: 4, 8]
            $table->foreignId('personnel_id')->constrained('personnel')->cascadeOnDelete();
            $table->foreignId('logistics_item_id')->constrained('logistics_items')->cascadeOnDelete();
            $table->integer('quantity_allocated');
            // Status workflow tracker (Pending -> Active -> Completed)[cite: 2, 8]
            $table->enum('status', ['Pending', 'Active', 'Completed'])->default('Pending');
            $table->text('mission_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('operations');
    }
};
