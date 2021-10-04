<?php

use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable("shops")) {
            $count = (int)$this->command->ask('Necha dona Ustun qo`shishim kerak?', 10);
            for ($i=1; $i < $count; $i++) {
                App\Shop::query()->updateOrCreate(['id' => $i], [
                    'name' =>'A'.' '.$i,
                    'created_at' =>date(now()),
                    'updated_at' =>null,
                ]);
                $this->command->info("{$i} ustun qo'shildi.");
            }
            $this->command->info("Jami {$i} ustun qo'shildi.");
        }
    }
}
