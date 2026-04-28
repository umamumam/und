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
        Schema::create('guests', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('invitation_id')->constrained()->onDelete('cascade');
            $blueprint->string('name');
            $blueprint->enum('attendance', ['hadir', 'tidak_hadir', 'ragu_ragu'])->nullable();
            $blueprint->text('message')->nullable();
            $blueprint->integer('guest_count')->default(0);
            $blueprint->boolean('is_opened')->default(false);
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
