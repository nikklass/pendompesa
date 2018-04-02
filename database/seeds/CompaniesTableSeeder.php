<?php

use App\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        $this->command->info('Truncating companies table');
        $this->truncateCompaniesTables();
        
        //create admin company
        $company = new \App\Company([
            'id' => '1',
            'name' => 'pendomedia',
            'description' => 'PendoMedia Admin Group',
            'physical_address' => 'Mombasa Plaza',
            'email' => 'info@pendo.co.ke',
            'box' => '123 Mombasa',
            'phone_number' => "254721735369",
            'created_by' => "1",
            'updated_by' => "1"
        ]);
        $company->save();

        factory(App\Company::class, 20)->create();

    }

    public function truncateCompaniesTables()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('companies')->truncate();
        \App\Company::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

}
