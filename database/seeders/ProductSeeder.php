<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Service;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Factory::create();
        $services = Service::pluck('id');

        for ($i = 1; $i <= 30; $i++) {
            $products[] = [
                'name'                  => $faker->sentence(2, true),
                'description'           => $faker->paragraph,
                'image'           => '',
                'price'                 => $faker->numberBetween(5, 200),
                'service_id'             => $services->random(),
                'category_id'           => null,
                'status'                => true,
                'created_at'            => now(),
                'updated_at'            => now(),
            ];
        }

        $chunks = array_chunk($products, 10);
        foreach ($chunks as $chunk) {
            Product::insert($chunk);
        }

    }
}
