<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
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
                App\Shop::query()->updateOrCreate(['id' => $i], [
                    'name' =>'Olma'.' '.$i,
                    'shop_id'=>2,
                    'price'=>"50 $",
                    'created_at' =>date(now()),

                ]);
                $this->command->info("{$i} ustun qo'shildi.");
            }
            $this->command->info("Jami {$i} ustun qo'shildi.");
        }
    }
}
