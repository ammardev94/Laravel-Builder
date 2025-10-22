<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('title')->nullable();
            $table->string('canonical_url')->nullable();
            $table->boolean('status')->default(true);
            $table->enum('type', ['static', 'dynamic'])->default('static');
            $table->enum('visibility', ['index-follow', 'no-index', 'no-follow'])->default('index-follow');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
