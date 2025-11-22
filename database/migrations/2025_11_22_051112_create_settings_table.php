<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->default('PressForge');
            $table->string('site_tagline')->nullable();

            $table->string('logo')->nullable();
            $table->string('logo_dark')->nullable();
            $table->string('favicon')->nullable();

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->json('social_links')->nullable();

            $table->integer('posts_per_page')->default(10);

            $table->boolean('rss_enabled')->default(true);
            $table->timestamps();
        });

          DB::table('settings')->insert([
            'site_name' => 'PressForge',
            'site_tagline' => 'Modern Laravel News & Blog CMS',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
