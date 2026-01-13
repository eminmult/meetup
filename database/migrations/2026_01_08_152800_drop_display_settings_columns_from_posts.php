<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn([
                'show_on_homepage',
                'show_in_slider',
                'show_in_video_section',
                'show_in_types_block',
                'show_in_important_today',
                'is_hidden',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('show_on_homepage')->default(true);
            $table->boolean('show_in_slider')->default(false);
            $table->boolean('show_in_video_section')->default(false);
            $table->boolean('show_in_types_block')->default(false);
            $table->boolean('show_in_important_today')->default(false);
            $table->boolean('is_hidden')->default(false);
        });
    }
};
