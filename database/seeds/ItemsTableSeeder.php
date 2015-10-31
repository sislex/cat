<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->delete();
        DB::table('items')->truncate();

        factory(App\Items::class, 10)->create();

        $this->command->info('Items table seeded!');
    }
}
