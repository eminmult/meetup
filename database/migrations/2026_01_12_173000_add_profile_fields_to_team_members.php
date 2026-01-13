<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            $table->string('tagline')->nullable()->after('bio');
            $table->json('stats')->nullable()->after('tagline');
            $table->json('skills')->nullable()->after('stats');
        });
    }

    public function down(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            $table->dropColumn(['tagline', 'stats', 'skills']);
        });
    }
};
