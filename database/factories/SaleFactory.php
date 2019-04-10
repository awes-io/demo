<?php

use Faker\Generator as Faker;
use Illuminate\Support\Carbon;
use App\Sections\Sales\Models\Sale;

$factory->define(Sale::class, function (Faker $faker) {
    return [
        'total' => $faker->numberBetween(1000, 9999),
        'created_at' => Carbon::now()
            ->subDays(random_int(0, 100))
            ->format('Y-m-d H:i:s')
    ];
});
