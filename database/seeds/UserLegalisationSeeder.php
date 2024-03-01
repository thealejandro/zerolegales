<?php

use Illuminate\Database\Seeder;

class UserLegalisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement ('SET FOREIGN_KEY_CHECKS=0;');
        DB::table ('user_legalisations')->truncate();

        DB::statement ('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('user_legalisations')->insert([
            'legalisation_status' => 'Enviada al Abogado', 
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('user_legalisations')->insert([
            'legalisation_status' => 'Listo para firmar', 
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('user_legalisations')->insert([
            'legalisation_status' => 'Entregado', 
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s')
        ]); 
    }
}
