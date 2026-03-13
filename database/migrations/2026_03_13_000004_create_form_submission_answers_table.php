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
        Schema::create('form_submission_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_submission_id')->constrained()->onDelete('cascade');
            $table->foreignId('form_field_id')->nullable()->constrained()->nullOnDelete();
            $table->string('field_key');
            $table->string('field_label');
            $table->string('field_type');
            $table->longText('answer_text')->nullable();
            $table->json('answer_json')->nullable();
            $table->timestamps();

            $table->index(['form_submission_id', 'field_key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_submission_answers');
    }
};

