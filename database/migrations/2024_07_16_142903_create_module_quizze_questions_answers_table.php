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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->integer('order');
            $table->timestamps();
        });

        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->timestamps();
        });

        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained()->onDelete('cascade');
            $table->text('content');
            $table->timestamps();
        });

        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->text('content');
            $table->boolean('is_correct')->default(false);
            $table->timestamps();
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->string('estimated_duration')->nullable();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->text('bio')->nullable();
            $table->string('photo')->nullable();
        });

        Schema::table('enrollments', function (Blueprint $table) {
            $table->string('status')->default('active');
        });
    }

    public function down()
    {
        Schema::dropIfExists('modules');
        Schema::dropIfExists('quizzes');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('answers');

        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('estimated_duration');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['bio', 'photo']);
        });

        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
