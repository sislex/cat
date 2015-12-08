<?php
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->truncate();

        User::create([
            'name' => 'Alex Rozhnov',
            'email' => 'sislex@ya.ru',
            'password' => Hash::make('pass')
        ]);

        User::create([
            'name' => 'Vitali Loseu',
            'email' => 'vloseu@gmail.com',
            'password' => Hash::make('pass')
        ]);

        User::create([
            'name' => 'Maxim Nadolski',
            'email' => 'maximusdreddoff@gmail.com',
            'password' => Hash::make('pass')
        ]);

        $this->command->info('User table seeded!');
    }

}
