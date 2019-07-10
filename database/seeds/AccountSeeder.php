<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB as DB;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Test Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password')
        ]);
    }
}
