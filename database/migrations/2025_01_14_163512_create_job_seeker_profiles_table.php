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
        Schema::create('job_seeker_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->text('address');
            $table->string('education_level');
            $table->string('major')->nullable();
            $table->string('institution');
            $table->year('graduation_year');
            $table->string('photo_path')->nullable();
            $table->string('id_card_path')->nullable();
            $table->string('certificate_path')->nullable();
            $table->string('work_experience_path')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('card_number')->nullable()->unique();
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_seeker_profiles');
    }
};
