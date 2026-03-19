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
        Schema::create('service_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
            $table->string('order_type');
            $table->string('title');
            $table->string('status')->default('pending');
            $table->string('status_text')->nullable();
            $table->string('authorized_person')->nullable();
            $table->string('agent_phone')->nullable();
            $table->string('owner_phone')->nullable();
            $table->text('description')->nullable();
            $table->text('address')->nullable();
            $table->string('consultation_full_name')->nullable();
            $table->string('consultation_phone_number')->nullable();
            $table->string('consultation_type')->nullable();
            $table->text('question')->nullable();
            $table->string('agent_name')->nullable();
            $table->text('location')->nullable();
            $table->string('report_url')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index(['order_type', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_orders');
    }
};
