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
        Schema::create('contact_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("contact_id");
            $table->string("type");
            $table->string("value");
            $table->string("comment")->nullable();
            $table->string("additionally")->nullable();
            $table->string("priority")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_items');
    }
};
