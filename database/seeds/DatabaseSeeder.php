<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(AdminRoleSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(DocumentTypeSeeder::class);
        $this->call(TermsAndConditionSeeder::class);
        $this->call(InputVariableTypeSeeder::class);
        $this->call(InputVariableSeeder::class);
        $this->call(SubscriptionTypeSeeder::class);
        $this->call(UserTypeSeeder::class);
        $this->call(DocumentStatusSeeder::class);
        $this->call(DownloadStatusSeeder::class);
        $this->call(UserLegalisationSeeder::class);
    }
}
