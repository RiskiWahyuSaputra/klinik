<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('doctor_number')->unique();
            $table->string('specialization')->nullable();
            $table->string('license_number')->nullable();
            $table->text('education')->nullable();
            $table->integer('experience_years')->nullable();
            $table->decimal('consultation_fee', 12, 2)->default(0);
            $table->text('bio')->nullable();
            $table->string('photo')->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
