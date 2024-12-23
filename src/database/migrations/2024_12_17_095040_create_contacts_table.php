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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("priority")
                ->default(0)
                ->comment("Приоритет вывода");

            $table->string("title")
                ->comment("Заголовок");

            $table->string("address")
                ->nullable()
                ->comment("Адрес");

            $table->string("description")
                ->nullable()
                ->comment("Описание");

            $table->string("latitude")
                ->nullable()
                ->comment("Широта");

            $table->string("longitude")
                ->nullable()
                ->comment("Долгота");

            $table->json("work_times")
                ->nullable()
                ->comment("Описание времени работы");

            $table->string("ico");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
