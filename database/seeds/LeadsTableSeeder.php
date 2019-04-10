<?php

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use App\Sections\Leads\Models\Lead;
use App\Sections\Sales\Models\Sale;

class LeadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 100;

        factory(Lead::class, $count)->create()->each(function ($lead) use ($count) {
            $lead->created_at = Carbon::now()
                ->subDays($count - $lead->id - random_int(0, $count - $lead->id))
                ->format('Y-m-d H:i:s');
            $lead->save();

            $saleCount = random_int(1, 20);

            for ($i=1; $i < $saleCount; $i++) { 
                $lead->sales()->save(factory(Sale::class)->make());
            }
        });
    }
}
