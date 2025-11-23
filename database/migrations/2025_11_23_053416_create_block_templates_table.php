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
        Schema::create('block_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); // hero, text, image_text, etc
            $table->json('data');   // block configuration
            $table->boolean('global')->default(false); // linked vs cloned
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('block_templates');
    }
};
