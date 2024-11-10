<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignedCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('assigned_courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_name');
            $table->string('teacher_name');
            $table->timestamp('assigned_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('assigned_courses');
    }
}
