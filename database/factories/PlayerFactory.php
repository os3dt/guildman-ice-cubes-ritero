<?php

namespace Database\Factories;

use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerFactory extends Factory
{
    protected $model = Player::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'server_id' => $this->faker->numerify('#################'),
            'discord_id' => $this->faker->numerify('#################'),
            'balance' => $this->faker->randomFloat(2, 0, 0),
        ];
    }
}
