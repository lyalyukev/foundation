<?php

namespace Database\Factories;

use App\Models\FundCollection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FundCollection>
 */
class FundCollectionFactory extends Factory
{
    protected $model = FundCollection::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(rand(3, 7)),
            'description' => $this->faker->text(rand(500, 2000)),
            'target_amount' => $this->faker->numberBetween(900000, 1000000),
            'link' => $this->faker->url(),
            'created_at' => now(),
        ];
    }
}
