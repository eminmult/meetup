<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->json('process')->nullable()->after('offers');
            $table->json('pricing')->nullable()->after('process');
            $table->json('faq')->nullable()->after('pricing');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['process', 'pricing', 'faq']);
        });
    }
};
