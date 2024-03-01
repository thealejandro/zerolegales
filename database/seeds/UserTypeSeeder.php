<?php

use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement ('SET FOREIGN_KEY_CHECKS=0;');
        DB::table ('user_types')->truncate();

        DB::statement ('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('user_types')->insert([
            'type_name' => 'No Subscription', 
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('user_types')->insert([
            'type_name' => 'Subscription', 
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('user_types')->insert([
            'type_name' => 'One Time Purchase', 
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s')
        ]); 
    }
}
