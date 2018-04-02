<?php

use App\SmsType;
use App\Status;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class BulkSmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void 
     */
    public function run()
    {

        /*$this->command->info('Truncating statuses and sms_types tables');
        $this->truncateBulkSmsTables();

        //sms types
        $sms_type = new \App\SmsType([
        	'id' => '1',
        	'name' => 'Registration SMS',
        	'description' => 'sent during registration'
        ]);
        $sms_type->save();

        $sms_type = new \App\SmsType([
        	'id' => '2',
        	'name' => 'Recommendation SMS',
        	'description' => 'recommendation sms to a friend'
        ]);
        $sms_type->save();

        $sms_type = new \App\SmsType([
        	'id' => '3',
        	'name' => 'Resent Registration SMS',
        	'description' => 'resent registration sms'
        ]);
        $sms_type->save();

        $sms_type = new \App\SmsType([
        	'id' => '4',
        	'name' => 'Forgot Password SMS',
        	'description' => 'when a user forgets password sms'
        ]);
        $sms_type->save();

        $sms_type = new \App\SmsType([
        	'id' => '5',
        	'name' => 'Confirm Number SMS',
        	'description' => 'when a user confirms their phone number sms'
        ]);
        $sms_type->save();

        $sms_type = new \App\SmsType([
        	'id' => '6',
        	'name' => 'Company Message SMS',
        	'description' => 'sms sent by the client company'
        ]);
        $sms_type->save();
        //end sms types


        //statuses
        $status = new \App\Status([
        	'id' => '1',
        	'name' => 'Active',
        	'section' => ''
        ]);
        $status->save();

        $status = new \App\Status([
        	'id' => '2',
        	'name' => 'Disabled',
        	'section' => ''
        ]);
        $status->save();

        $status = new \App\Status([
        	'id' => '3',
        	'name' => 'Suspended',
        	'section' => ''
        ]);
        $status->save();

        $status = new \App\Status([
        	'id' => '4',
        	'name' => 'Expired',
        	'section' => ''
        ]);
        $status->save();

        $status = new \App\Status([
        	'id' => '5',
        	'name' => 'Pending',
        	'section' => ''
        ]);
        $status->save();

        $status = new \App\Status([
        	'id' => '6',
        	'name' => 'Confirmed',
        	'section' => ''
        ]);
        $status->save();

        $status = new \App\Status([
        	'id' => '7',
        	'name' => 'Cancelled',
        	'section' => ''
        ]);
        $status->save();

        $status = new \App\Status([
        	'id' => '8',
        	'name' => 'Sent',
        	'section' => ''
        ]);
        $status->save();

        $status = new \App\Status([
        	'id' => '99',
        	'name' => 'Inactive',
        	'section' => ''
        ]);
        $status->save();
        //end statuses
        */

    }


    public function truncateBulkSmsTables()
    {
        /*DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('statuses')->truncate();
        DB::table('sms_types')->truncate();
        \App\Status::truncate();
        \App\SmsType::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');*/
    }

}