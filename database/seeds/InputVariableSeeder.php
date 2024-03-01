<?php

use Illuminate\Database\Seeder;

class InputVariableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('input_variables')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('input_variables')->insert([
            'variable_name' => 'Primer Nombres',
            'variable_type' => 1,
            'created_by'=>1,
            'updated_by'=>null,
            'deleted_by'=>null,
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s'),
            'user_relation'=>1
        ]);
        DB::table('input_variables')->insert([
            'variable_name' => 'Primer Apellido',
            'variable_type' => 1,
            'created_by'=>1,
            'updated_by'=>null,
            'deleted_by'=>null,
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s'),
            'user_relation'=>1

        ]);
        DB::table('input_variables')->insert([
            'variable_name' => 'Fecha de nacimiento',
            'variable_type' => 3,
            'created_by'=>1,
            'updated_by'=>null,
            'deleted_by'=>null,
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s'),
            'user_relation'=>1

        ]);
        DB::table('input_variables')->insert([
            'variable_name' => 'Dirección',
            'variable_type' => 1,
            'created_by'=>1,
            'updated_by'=>null,
            'deleted_by'=>null,
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s'),
            'user_relation'=>1

        ]);
    }
}
