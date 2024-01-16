<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('show_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('show_id');
            $table->string('title');
            $table->date('release_date');
            $table->string('genres');
            $table->unsignedTinyInteger('type');
            $table->json('other_details');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('show_lists');
    }
};
