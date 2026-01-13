<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop pivot tables first
        Schema::dropIfExists('post_tag');
        Schema::dropIfExists('post_post_type');

        // Drop main tables
        Schema::dropIfExists('tags');
        Schema::dropIfExists('post_types');
    }

    public function down(): void
    {
        // We don't restore these tables
    }
};
