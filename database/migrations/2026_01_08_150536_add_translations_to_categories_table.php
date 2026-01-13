<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->json('translations')->nullable()->after('description');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->json('translations')->nullable()->after('content');
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->json('translations')->nullable()->after('slug');
        });

        Schema::table('static_pages', function (Blueprint $table) {
            $table->json('translations')->nullable()->after('content');
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('translations');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('translations');
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->dropColumn('translations');
        });

        Schema::table('static_pages', function (Blueprint $table) {
            $table->dropColumn('translations');
        });
    }
};
