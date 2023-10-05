<?php

namespace Database\Factories;

use App\Booking;
use App\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        $start = Carbon::make($this->faker->dateTimeBetween('-1 year', '+1 year'));
        $end = $start->copy()->addMinutes($this->faker->randomElement([15, 30, 45, 60, 75, 90]));

        return [
            'start' => $start,
            'end' => $end,
            'notes' => $this->faker->boolean(30) ? $this->faker->paragraphs(1, true) : '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'client_id' => Client::factory(),
        ];
    }

    public function forClient(Client $client): static
    {
        return $this->state(fn () => [
            'client_id' => $client->id,
        ]);
    }
}
