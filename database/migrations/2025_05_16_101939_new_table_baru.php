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
        Schema::create('new_table_baru', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name', 100);
            $table->integer('votes');
            $table->text('description');
            $table->dateTime('created_at');
            $table->string('name_char');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_table_baru');
    }
};
