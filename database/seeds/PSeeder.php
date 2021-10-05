<?php

use Illuminate\Database\Seeder;

class PSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable("products")) {
            $count = (int)$this->command->ask('Necha dona Ustun qo`shishim kerak?', 10);
            for ($i=1; $i < $count; $i++) {
                App\Product::query()->updateOrCreate(['id' => $i], [
                    'name' =>'Olma'.' '.$i,
                    'shop_id'=> App\Shop::all()->random()->id,
                    'price'=>"50 $",
                    'created_at' =>date(now()),

                ]);
                $this->command->info("{$i} ustun qo'shildi.");
            }
            $this->command->info("Jami {$i} ustun qo'shildi.");
        }
    }
}
