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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('citizen_id')->nullable();
            $table->string('department');
            $table->string('category');
            $table->string('station')->nullable();
            $table->text('message')->nullable();
            $table->string('video')->nullable();
            $table->string('recording')->nullable();
            $table->string('status');
            $table->date('date');
            $table->time('time');
            $table->decimal('lat', 10, 7);
            $table->decimal('lng', 10, 7);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
