<?php

namespace Database\Factories;

use App\Models\Building;
use App\Models\Category;
use App\Models\Room;
use App\Models\User;
use App\Services\Inventories\InventoryService;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $room = Room::query()->inRandomOrder()->first() ?? Room::factory()->create();

        return [
            'created_by' => User::query()->inRandomOrder()->first()?->id ?? User::factory()->create()->id,
            'code' => (new InventoryService())->generateCode(),
            'name' => $this->faker->word,
            'category_id' => Category::query()->inRandomOrder()->first()?->id ?? Category::factory()->create()->id,
            'description' => $this->faker->text,
            'spesification' => $this->faker->text,
            'origin_of_acquisition' => $this->faker->text,
            'building_id' => $room->building_id,
            'room_id' => $room->id,
            'series_number' => Str::uuid(),
            'brand' => $this->faker->word,
            'type' => $this->faker->word,
            'color' => $this->faker->word,
            'quantity' => $this->faker->randomNumber(),
            'procurement_year' => $this->faker->year(),
            'price' => $this->faker->randomNumber(),
            'registration_date' => $this->faker->dateTime(),
            'photo' => $this->faker->image('storage/app/public/inventories', 640, 480, null, false) ,
        ];
    }
}
