<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->nullable();
            $table->string('title')->nullable();
            $table->string('level')->nullable();
            $table->text('content')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('instructor_id')->constrained('users');
            $table->foreignId('category_id')->constrained('categories');
            $table->decimal('price', 8, 2);
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
