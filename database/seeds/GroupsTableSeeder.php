<?php

use App\Group;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$this->command->info('Truncating companies table');
        $this->truncateGroupTables();
        
        factory(App\Group::class, 100)->create();*/

    }

    public function truncateGroupTables()
    {
        /*DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('groups')->truncate();
        \App\Group::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');*/
    }

}
