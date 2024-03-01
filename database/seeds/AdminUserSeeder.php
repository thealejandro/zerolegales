<?php

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('admins')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('admins')->insert([
            'name' => 'System Admin',
            'email' => 'systemadmin@admin.com',
            'is_admin'=>1,
            'is_active'=>1,
            'role_id'=>1,
            'password'=>\Hash::make('password'),
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
