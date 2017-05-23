<?php
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->delete();
        App\User::create(array(
            'name'     => 'Fabrizio Noviello',
            'email'    => 'fabri@testmails.be',
            'password' => Hash::make('pxl'),
        ));
    }

}