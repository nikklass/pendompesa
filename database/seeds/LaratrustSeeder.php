<?php

use App\Permission;
use App\Role;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaratrustSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return  void
     */
    public function run()
    {
        
        $faker = Faker::create();

        $this->command->info('Truncating User, Role and Permission tables');
        $this->truncateLaratrustTables();
        
        $config = config('laratrust_seeder.role_structure');
        $userPermission = config('laratrust_seeder.permission_structure');
        $mapPermission = collect(config('laratrust_seeder.permissions_map'));

        foreach ($config as $key => $modules) {
            
            // Create a new role
            $role = Role::create([
                'name' => $key,
                'uuid' => $faker->uuid,
                'display_name' => ucwords(str_replace("_", " ", $key)),
                'description' => ucwords(str_replace("_", " ", $key))
            ]);

            $this->command->info('Creating Role '. strtoupper($key));

            // Reading role permission modules
            foreach ($modules as $module => $value) {
                $permissions = explode(',', $value);

                foreach ($permissions as $p => $perm) {
                    $permissionValue = $mapPermission->get($perm);

                    //dump($permissionValue . '-xxx-' . $module);

                    //check if perm exists
                    $permission_data = Permission::where('name', $permissionValue . '-' . $module)->first();

                    if (!$permission_data) {
                        $permission = Permission::create([
                            'name' => $permissionValue . '-' . $module,
                            'uuid' => $faker->uuid,
                            'display_name' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                            'description' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                        ]);
                    } else {
                        $permission = $permission_data;
                    }

                    $this->command->info('Creating Permission to '.$permissionValue.' for '. $module);
                    
                    if (!$role->hasPermission($permission->name)) {
                        $role->attachPermission($permission);
                    } else {
                        $this->command->info($key . ': ' . $p . ' ' . $permissionValue . ' already exist');
                    }
                }
            }

            $this->command->info("Creating '{$key}' user");
            // Create default user for each role
            $i = 1;
            $user = \App\User::create([
                'first_name' => ucwords(str_replace("_", " ", $key)),
                //'last_name' => ucwords(str_replace("_", " ", $key)),
                //'phone' => "07" . $faker->numberBetween(10,39) . $faker->numberBetween(100000,999999),
                'phone' => '072074321' . $i,
                'company_id' => '1',
                'phone_country' => 'KE',
                'status_id' => '1',
                'active' => '1',
                'uuid' => $faker->uuid,
                'email' => $key.'@pendo.co.ke',
                'gender' => $faker->randomElement($array = array ('m','f')),
                'password' => '123',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => '1'
            ]);
            $i++;

            //get team id
            //$team_id = '1'; 

            $user->attachRole($role);

        }

        // creating user with permissions
        if (!empty($userPermission)) {
            foreach ($userPermission as $key => $modules) {
                foreach ($modules as $module => $value) {
                    $permissions = explode(',', $value);
                    // Create default user for each permission set
                    $user = \App\User::create([
                        'name' => ucwords(str_replace("_", " ", $key)),
                        'email' => $key.'@pendo.co.ke',
                        'password' => bcrypt('123'),
                        'remember_token' => str_random(10),
                    ]);
                    foreach ($permissions as $p => $perm) {
                        $permissionValue = $mapPermission->get($perm);

                        $permission = \App\Permission::firstOrCreate([
                            'name' => $permissionValue . '-' . $module,
                            'uuid' => $faker->uuid,
                            'display_name' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                            'description' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                        ]);

                        $this->command->info('Creating Permission to '.$permissionValue.' for '. $module);
                        
                        if (!$user->hasPermission($permission->name)) {
                            $user->attachPermission($permission);
                        } else {
                            $this->command->info($key . ': ' . $p . ' ' . $permissionValue . ' already exist');
                        }
                    }
                }
            }
        }

        
    }

    public function truncateLaratrustTables()
    {
        
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        
        DB::table('permission_role')->truncate();
        DB::table('permission_user')->truncate();
        DB::table('role_user')->truncate();
        DB::table('permissions')->truncate();
        DB::table('roles')->truncate();
        DB::table('users')->truncate();
        /*\App\User::truncate();
        \App\Role::truncate();
        \App\Permission::truncate();*/

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }

}
