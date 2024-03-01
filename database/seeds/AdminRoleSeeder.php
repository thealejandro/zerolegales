<?php

use Illuminate\Database\Seeder;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement ('SET FOREIGN_KEY_CHECKS=0;');
        DB::table ('admin_roles')->truncate();

        DB::statement ('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('admin_roles')->insert([
            'role_name' => 'System Admin', 
            'is_active' => '1',
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
