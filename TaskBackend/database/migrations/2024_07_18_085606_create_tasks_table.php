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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('creator')->nullable()->constrained('users');
            $table->foreignId('team_id')->nullable()->constrained('teams');
            $table->string('title');
            $table->text('description');
            $table->string('estimated_effort');
            $table->string('priority');
            $table->string('labels');
            $table->date('due_date');
            $table->string('status')->default('inPending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
