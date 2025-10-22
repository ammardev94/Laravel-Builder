<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('page_section_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_section_id')->constrained('page_sections')->onDelete('cascade');
            $table->string('field_name');
            $table->string('field_label')->nullable();
            $table->enum('field_type', ['text','textarea','file','link','video','image'])->default('text');
            $table->text('field_value')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_section_fields');
    }
};
