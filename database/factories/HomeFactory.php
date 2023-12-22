<?php

namespace Database\Factories;

use App\Models\Home;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Home>
 */
class HomeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'subtitle' => $this->faker->sentence(1),
            'description' => $this->faker->paragraph(4),
            'price' => $this->faker->randomFloat(2, 100, 1000),
        ];
    }

    /**
     * Add main image to the home.
     */
    public function withMainImage(): self
    {
        return $this->afterCreating(function (Home $home) {
            foreach (Arr::random(Storage::disk('local')->files('faker/homes'), 1) as $file) {
                $home->addMediaFromDisk($file, 'local')
                    ->preservingOriginal()
                    ->setFileName(implode('-', [$home->code, substr(sha1($file), 0, 6)]) . '.' . pathinfo($file, PATHINFO_EXTENSION))
                    ->toMediaCollection('main');
            }
        });
    }

    /**
     * Add gallery images to the home.
     */
    public function withGalleryImages(): self
    {
        return $this->afterCreating(function (Home $home) {
            foreach (Arr::random(Storage::disk('local')->files('faker/gallery'), 3) as $file) {
                $home->addMediaFromDisk($file, 'local')

                    ->preservingOriginal()
                    ->setFileName(implode('-', [$home->code, substr(sha1($file), 0, 6)]) . '.' . pathinfo($file, PATHINFO_EXTENSION))
                    ->toMediaCollection('gallery');
            }
        });
    }
}
