<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Home;
use App\Models\City;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $citySchoorl = City::factory()->create([
            'name' => 'Schoorl',
        ]);

        $cityVorden = City::factory()->create([
            'name' => 'Vorden',
        ]);

        Home::factory()
            ->withMainImage()
            ->withGalleryImages()
            ->create([
                'city_id' => $citySchoorl->id,
                'name' => 'Vakantiehuis Schoorl',
                'price' => 479,
            ]);

        Home::factory()
            ->withMainImage()
            ->withGalleryImages()
            ->create([
                'city_id' => $cityVorden->id,
                'name' => 'Vakantiehuis Vorden',
                'price' => 1400,
            ]);

        Home::factory()
            ->withMainImage()
            ->withGalleryImages()
            ->create([
                'city_id' => $cityVorden->id,
                'name' => 'Vakantiehuis Steenwijk',
                'price' => 1200,
            ]);

        Home::factory()
            ->withMainImage()
            ->withGalleryImages()
            ->create([
                'city_id' => $cityVorden->id,
                'name' => 'Vakantiehuis Meppel',
                'price' => 1200,
            ]);
    }
}
