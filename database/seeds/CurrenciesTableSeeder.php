<?php

use Illuminate\Database\Seeder;
use App\Currencies;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currencies::create([
            'name' => 'USD',
            'rate' => '1.0',
            'icon' => '$',
            'default' => true
        ]);

        $this->command->info('Currencies table seeded!');
    }
}
