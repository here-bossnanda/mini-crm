<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Ketika Seeder dijalan maka hapus dulu data yang ada di table
        //untuk menghindari duplikasi data
        DB::table('users')->delete();
        //jalankan seeder
        DB::table('users')->insert(array(
            ['email' => 'admin@admin.com','username' => 'Admin','password' => bcrypt('admin'),'created_at' => now(),'updated_at' => now()]
        ));
    }
}
