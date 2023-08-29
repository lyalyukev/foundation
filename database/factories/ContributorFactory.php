<?php

namespace Database\Factories;

use App\Models\Contributor;
use App\Models\FundCollection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contributor>
 */
class ContributorFactory extends Factory
{
    protected $model = Contributor::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_name' => $this->faker->name,
            'amount' => $this->faker->numberBetween(1000, 99000),
            'collection_id' => FundCollection::factory()
        ];
    }
}
