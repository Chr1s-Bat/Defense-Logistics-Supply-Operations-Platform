<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('personnel', function (Blueprint $table) {
            $table->id();
            // One-to-One / Foreign key relation linked to users
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('rank');
            $table->string('unit_code');
            $table->string('clearance_level');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('personnel');
    }
};
