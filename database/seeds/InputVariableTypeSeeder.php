<?php

use Illuminate\Database\Seeder;

class InputVariableTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('input_variable_types')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('input_variable_types')->insert([
            'variable_type' => 'string',
            'description'=>'Para valores alfanuméricos',
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('input_variable_types')->insert([
            'variable_type' => 'integer',
            'description'=>'Para valores numéricos',
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('input_variable_types')->insert([
            'variable_type' => 'date',
            'description'=>'Para valores de fecha',
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('input_variable_types')->insert([
            'variable_type' => 'decimal',
            'description'=>'Para valores de precio',
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('input_variable_types')->insert([
            'variable_type' => 'year',
            'description'=>'Para valores de tipo de años',
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
