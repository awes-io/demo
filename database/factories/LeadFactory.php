<?php

use Faker\Generator as Faker;
use Illuminate\Support\Carbon;
use App\Sections\Leads\Models\Lead;

$factory->define(Lead::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'is_premium' => $faker->numberBetween(1, 4),
    ];
});
