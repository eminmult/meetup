<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content')->nullable();
            $table->text('excerpt')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('price_text')->nullable(); // "от 100 ₼" или "по договоренности"
            $table->string('duration')->nullable(); // Длительность услуги
            $table->string('icon')->nullable(); // Иконка услуги
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->boolean('is_published')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->json('translations')->nullable();
            $table->timestamps();
        });

        // Pivot table for service categories
        Schema::create('category_service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->unique(['service_id', 'category_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_service');
        Schema::dropIfExists('services');
    }
};
