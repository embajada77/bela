<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->createOwner();
    	$this->createAdmin();
    	$this->createUser();
    }

    protected function createOwner()
    {
        $user = factory(App\User::class)->create([
        	'email' => 'gmartinezvogt@gmail.com',
        	'name' => 'owner',
        	'password' => bcrypt('1234')
        ]);

        $user->assign('owner');
    }

    protected function createAdmin()
    {
        $user =factory(App\User::class)->create([
        	'email' => 'embajada77@gmail.com',
        	'name' => 'admin',
        	'password' => bcrypt('1234')
        ]);

        $user->assign('admin');
    }

    protected function createUser()
    {
        $user = factory(App\User::class)->create([
        	'email' => 'gmartinezvogt@hotmail.com',
        	'name' => 'user',
        	'password' => bcrypt('1234')
        ]);

        $user->assign('user');
    }
}
