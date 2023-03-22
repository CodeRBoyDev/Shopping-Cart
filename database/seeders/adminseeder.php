<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class adminseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new \App\Models\User();
        $admin->email = 'admin@shop.ph';
        $admin->name = "administrator";
        $admin->password = bcrypt("password");
        $admin->isAdmin = 1;
        $admin->save();
    }
}
