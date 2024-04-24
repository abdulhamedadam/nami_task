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
        Schema::create('tbl_sub_tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('main_task_id')->nullable();
            $table->string('name')->nullable();
            $table->string('date_ar')->nullable();
            $table->string('date_st')->nullable();
            $table->string('time')->nullable();
            $table->enum('status',['notfinished','finished'])->default('notfinished');
            $table->timestamps();

            $table->index('name');
            $table->index('main_task_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_sub_tasks');
    }
};
