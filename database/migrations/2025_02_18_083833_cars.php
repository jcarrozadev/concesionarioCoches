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
        Schema::create('cars', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement()->primary();
            $table->string('name', 100);
            $table->unsignedInteger('brand_id');
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('color_id');
            $table->year('year');
            $table->string('main_img', 50);
            $table->decimal('horsepower', 5, 2);
            $table->decimal('price', 9, 2);
            $table->boolean('sale');
            $table->boolean('enabled');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade')->onUpdate('cascade');;
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade')->onUpdate('cascade');;
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade')->onUpdate('cascade');;
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
