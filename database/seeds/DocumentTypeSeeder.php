<?php

use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement ('SET FOREIGN_KEY_CHECKS=0;');
        DB::table ('document_types')->truncate();

        DB::statement ('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('document_types')->insert([
            'type_name' => 'Documento', 
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('document_types')->insert([
            'type_name' => 'Listado', 
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
