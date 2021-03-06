<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //membuat  role Admin
        $adminRole = new Role();
        $adminRole->name = "admin";
        $adminRole->display_name = "Admin";
        $adminRole->save();

        //membuat role member
        $memberRole = new Role();
        $memberRole->name = "member";
        $memberRole->display_name = "Member";
        $memberRole->save();

        //memnbuat sample admin
        $admin = new User();
        $admin->name ='Admin';
        $admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('srahasia');
        $admin->save();
        $admin->attachRole($adminRole);

        //memnbuat sample member
        $member = new User();
        $member->name ='Member';
        $member->email = 'member@gmail.com';
        $member->password = bcrypt('rahasia');
        $member->save();
        $member->attachRole($memberRole);
        
    }
}
