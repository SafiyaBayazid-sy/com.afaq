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
        Schema::table('visitor_tracking', function (Blueprint $table) {
            $table->uuid('visitor_id')->nullable()->after('id');
            $table->string('utm_term')->nullable()->after('utm_campaign');
            $table->string('utm_content')->nullable()->after('utm_term');
            $table->string('landing_path')->nullable()->after('utm_content');
            $table->text('referrer_url')->nullable()->after('landing_path');
            $table->string('ip_address', 45)->nullable()->after('referrer_url');
            $table->text('user_agent')->nullable()->after('ip_address');

            $table->index('visitor_id');
            $table->index('visited_at');
            $table->index('utm_source');
            $table->index('utm_campaign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visitor_tracking', function (Blueprint $table) {
            $table->dropIndex(['visitor_id']);
            $table->dropIndex(['visited_at']);
            $table->dropIndex(['utm_source']);
            $table->dropIndex(['utm_campaign']);

            $table->dropColumn([
                'visitor_id',
                'utm_term',
                'utm_content',
                'landing_path',
                'referrer_url',
                'ip_address',
                'user_agent',
            ]);
        });
    }
};
