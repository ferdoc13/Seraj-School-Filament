<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dish;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dish::create([
            'name' => 'قیمه',
            'description' => 'قیمه با گوجه فرنگی و پیاز',
            'price' => 100000,
            'status' => true,
        ]);
        Dish::create([
            'name' => 'پیتزا',
            'description' => 'پیتزا با گوجه فرنگی و پیاز',
            'price' => 150000,
            'status' => true,
        ]);
        Dish::create([
            'name' => 'قرمه سبزی',
            'description' => 'قرمه سبزی با گوجه فرنگی و پیاز',
            'price' => 100000,
            'status' => true,
        ]);
        Dish::create([
            'name' => 'کلم پلو شیرازی',
            'description' => 'کلم پلو شیرازی با گوجه فرنگی و پیاز',
            'price' => 250000,
            'status' => true,
        ]);

    }
}
