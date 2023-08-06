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
        Schema::create('bookables', function (Blueprint $table) {
            $table->bigInteger('book_id')->unsigned();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->morphs('bookable');

            $table->foreign('book_id')->references('id')->on('books');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookables');
    }
};
