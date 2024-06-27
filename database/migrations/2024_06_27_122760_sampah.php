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
        Schema::create('sampahs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('garbage_type');
            $table->unsignedBigInteger('category_id')->index();
            $table->foreign('category_id')->on('categories')->references('id')->onUpdate('cascade');
            $table->integer('price');
            $table->string('satuan')->default('KG');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Sampah');
    }
};
