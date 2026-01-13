<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Основная таблица событий
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->json('translations')->nullable(); // title, description на разных языках
            $table->string('icon')->nullable(); // emoji или название иконки
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Регулярное расписание (каждую пятницу в 19:00)
        Schema::create('event_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->tinyInteger('day_of_week'); // 1=Пн, 2=Вт, 3=Ср, 4=Чт, 5=Пт, 6=Сб, 7=Вс
            $table->time('start_time');
            $table->time('end_time')->nullable();
            $table->timestamps();
        });

        // Конкретные даты (15 января в 18:00)
        Schema::create('event_dates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time')->nullable();
            $table->string('note')->nullable(); // примечание к конкретной дате
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_dates');
        Schema::dropIfExists('event_schedules');
        Schema::dropIfExists('events');
    }
};
