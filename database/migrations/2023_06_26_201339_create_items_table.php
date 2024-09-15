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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->longText('image');
            $table->string('name', 100);
            $table->string('item_number', 10)->unique();
            $table->enum('category', ['アウター', 'トップス', 'ボトムス', 'シューズ', '小物'])->index();
            $table->enum('size', ['S', 'M', 'L', 'XL', 'F']);
            $table->string('price', 10)->index();
            $table->unsignedInteger('stock')->index();
            $table->text('note', 300)->comment('備考')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
