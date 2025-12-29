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
        Schema::create('dynamic_fields', function (Blueprint $table) {
            $table->id();

            $table->foreignId('template_id')->constrained()->cascadeOnDelete();

            $table->string('name', 100);
            $table->string('label', 120);

            $table->enum('type', ['text','number','select','date','checkbox']);
            $table->json('options')->nullable();
            $table->boolean('required')->default(false);

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dynamic_fields');
    }
};
