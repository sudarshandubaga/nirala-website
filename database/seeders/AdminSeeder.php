<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $admin = new Admin();
        // $admin->name = "Mr. Admin";
        // $admin->login = "nirala_website";
        // $admin->password = Hash::make('admin@123');
        // $admin->save();

        $admin = new Admin();
        $admin->name = "HR Manager";
        $admin->login = "hr_admin";
        $admin->password = Hash::make('example@123');
        $admin->role = 'hr';
        $admin->save();

        $admin = new Admin();
        $admin->name = "Enquiry Manager";
        $admin->login = "enquiry_admin";
        $admin->password = Hash::make('example@123');
        $admin->role = 'enquiry';
        $admin->save();

        $admin = new Admin();
        $admin->name = "Data Operator";
        $admin->login = "data_feed_admin";
        $admin->password = Hash::make('example@123');
        $admin->role = 'feed';
        $admin->save();
    }
}
