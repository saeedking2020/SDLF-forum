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
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('desc');
            $table->foreignId('forum_id')->constrained()->onDelete('cascade');
            $table->integer('is_deleted')->default(0);
            $table->string('image')->nullable();
            $table->integer('views')->default(0);
            $table->integer('notify')->default(0);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topics');
    }
};
