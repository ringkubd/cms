<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AceessDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
       DB::unprepared(file_get_contents(base_path('_sql/access-control/admin_menus.sql')));
       $this->command->info('Admin Menu, Data seeded!');
       DB::unprepared(file_get_contents(base_path('_sql/access-control/roles.sql')));
       $this->command->info('Roles, Data seeded!');
       DB::unprepared(file_get_contents(base_path('_sql/access-control/users.sql')));
       $this->command->info('Users, Data seeded!');
       DB::unprepared(file_get_contents(base_path('_sql/access-control/user_permissions.sql')));
       $this->command->info('User-permission, Data seeded!');
       DB::unprepared(file_get_contents(base_path('_sql/access-control/settings.sql')));
       $this->command->info('Settings, Data seeded!');
        DB::unprepared(file_get_contents(base_path('_sql/access-control/start_from_access_control.sql')));
        $this->command->info('Starter, Data seeded!');
    }
}
