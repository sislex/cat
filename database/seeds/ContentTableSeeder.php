<?php

use Illuminate\Database\Seeder;

class ContentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('content')->delete();
        DB::table('content')->truncate();

        $this->command->info('Content table seeded!');
    }
}
