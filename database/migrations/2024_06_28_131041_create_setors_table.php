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
        Schema::create('setors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('garbage_id')->index();
            $table->foreign('garbage_id')->on('sampahs')->references('id')->onUpdate('cascade');
            $table->bigInteger('weight');
            $table->enum('is_sold', ['0', '1'])->default('0'); // 0 : not sold, 1 is sold
            $table->enum('is_withdrawn', ['0', '1'])->default('0'); // 0 : not withdrawn, 1 is withdrawn
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setors');
    }
};
