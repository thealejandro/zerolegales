<?php

use Illuminate\Database\Seeder;

class DocumentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement ('SET FOREIGN_KEY_CHECKS=0;');
        DB::table ('document_statuses')->truncate();

        DB::statement ('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('document_statuses')->insert([
            'document_status' => 'Incompleto', 
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('document_statuses')->insert([
            'document_status' => 'Completo', 
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s')
        ]); 
    }
}
