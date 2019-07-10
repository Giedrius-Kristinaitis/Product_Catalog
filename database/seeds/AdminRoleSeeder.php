<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB as DB;
use App\User as User;
use App\Role as Role;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userId = User::where('email', 'admin@admin.com')->value('id');
        $roleId = Role::where('name', 'admin')->value('id');

        DB::table('role_user')->insert([
            'user_id' => $userId,
            'role_id' => $roleId
        ]);
    }
}
