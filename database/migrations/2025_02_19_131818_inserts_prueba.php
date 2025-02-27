<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('brands')->insert([
            ['name' => 'Audi', 'enabled' => 1],
            ['name' => 'BMW', 'enabled' => 1],
            ['name' => 'Seat', 'enabled' => 1],
        ]);

        DB::table('colors')->insert([
            ['name' => 'Azul', 'hex' => '#4287f5', 'enabled' => 1],
            ['name' => 'Amarillo', 'hex' => '#f5e642', 'enabled' => 1],
            ['name' => 'Rojo', 'hex' => '#f54242', 'enabled' => 1],
        ]);

        DB::table('types')->insert([
            ['name' => 'SUV', 'enabled' => 1],
            ['name' => 'Deportivo', 'enabled' => 1],
            ['name' => 'Pick Up', 'enabled' => 1],
            ['name' => 'Caravana', 'enabled' => 1],
        ]);

        DB::table('cars')->insert([
            ['name' => 'A1', 'brand_id' => 1, 'color_id' => 1, 'type_id' => 1, 'year' => 2019, 'main_img' => 'audi_a1.jpg', 'horsepower' => 150, 'price' => 250000.44, 'sale' => 1, 'enabled' => 1],
            ['name' => 'A3', 'brand_id' => 1, 'color_id' => 2, 'type_id' => 2, 'year' => 2018, 'main_img' => 'audi_a3.jpg', 'horsepower' => 200, 'price' => 32415, 'sale' => 1, 'enabled' => 1],
            ['name' => 'A4', 'brand_id' => 1, 'color_id' => 3, 'type_id' => 3, 'year' => 2017, 'main_img' => 'audi_a4.jpg', 'horsepower' => 250, 'price' => 5445.99, 'sale' => 0, 'enabled' => 1],
            ['name' => 'Cordoba', 'brand_id' => 3, 'color_id' => 2, 'type_id' => 2, 'year' => 2002, 'main_img' => 'cordoba.jpg', 'horsepower' => 93, 'price' => 12343, 'sale' => 0, 'enabled' => 1],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('cars')->whereIn('name', ['A1', 'A3', 'A4', 'Cordoba'])->delete();
        DB::table('colors')->whereIn('name', ['Azul', 'Amarillo', 'Rojo'])->delete();
        DB::table('brands')->whereIn('name', ['Audi', 'BMW', 'Seat'])->delete();
        DB::table('types')->whereIn('name', ['SUV', 'Deportivo', 'Pick Up', 'Caravana'])->delete();
    }
};
