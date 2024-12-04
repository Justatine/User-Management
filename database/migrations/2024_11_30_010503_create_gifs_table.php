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
        Schema::create('gifs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid');   
            $table->text('image');
            $table->text('title');
            $table->integer('download_count')->default(0);
            $table->timestamps();

            $table->foreign('userid')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gifs');
    }
};
