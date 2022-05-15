<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'grade' => $this->faker->numberBetween(1,4),
            'gender' => $this->faker->randomElement(['男','女','その他']),
            'part' => $this->faker->randomElement(['ギター','ドラム','ベース','ボーカル','キーボード']),
        ];
    }
}
