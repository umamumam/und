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
        // 1. Invitations Main Table
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('slug')->unique();
            $table->string('title');
            $table->dateTime('wedding_date');
            $table->string('cover_photo')->nullable();
            $table->text('quote_verse')->nullable();
            $table->string('quote_source')->nullable();
            $table->string('video_url')->nullable();
            $table->string('live_streaming_url')->nullable();
            $table->text('dress_code')->nullable();
            $table->string('bg_music')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 2. Couples Details
        Schema::create('couples', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invitation_id')->constrained()->onDelete('cascade');
            $table->enum('gender', ['male', 'female']);
            $table->string('full_name');
            $table->string('nickname');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('instagram_username')->nullable();
            $table->string('photo')->nullable();
            $table->string('child_order')->nullable(); // e.g., "Putra Pertama"
            $table->timestamps();
        });

        // 3. Wedding Events
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invitation_id')->constrained()->onDelete('cascade');
            $table->string('type'); // e.g., "Akad Nikah", "Resepsi"
            $table->date('date');
            $table->time('start_time');
            $table->string('end_time')->default('Selesai');
            $table->string('location_name');
            $table->text('location_address');
            $table->text('google_maps_url')->nullable();
            $table->timestamps();
        });

        // 4. Love Stories (Timeline)
        Schema::create('love_stories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invitation_id')->constrained()->onDelete('cascade');
            $table->string('year')->nullable();
            $table->string('title');
            $table->text('story');
            $table->string('image')->nullable();
            $table->timestamps();
        });

        // 5. Gallery
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invitation_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['image', 'video'])->default('image');
            $table->string('url');
            $table->timestamps();
        });

        // 6. Wedding Gifts / Bank Accounts
        Schema::create('gifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invitation_id')->constrained()->onDelete('cascade');
            $table->string('bank_name');
            $table->string('account_number');
            $table->string('account_name');
            $table->string('qr_code')->nullable();
            $table->timestamps();
        });

        // 7. Wishes / RSVP
        Schema::create('wishes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invitation_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('message');
            $table->enum('attendance_status', ['hadir', 'tidak_hadir', 'ragu_ragu'])->default('hadir');
            $table->integer('guest_count')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishes');
        Schema::dropIfExists('gifts');
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('love_stories');
        Schema::dropIfExists('events');
        Schema::dropIfExists('couples');
        Schema::dropIfExists('invitations');
    }
};
