<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Band>
 */
class BandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->realText(10),
            'genre' => $this->faker->randomElement(['ジャズ','ロック','メタル','JPOP','フォーク']),
            'count_members' => $this->faker->numberBetween(1,6),
            'summary' => $this->faker->realText(20),
        ];
    }
}
