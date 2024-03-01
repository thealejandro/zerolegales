<?php

use Illuminate\Database\Seeder;

class DownloadStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement ('SET FOREIGN_KEY_CHECKS=0;');
        DB::table ('download_statuses')->truncate();

        DB::statement ('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('download_statuses')->insert([
            'status_name' => 'Completo', 
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('download_statuses')->insert([
            'status_name' => 'Incompleto', 
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
