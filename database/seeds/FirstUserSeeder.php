<?php

use Illuminate\Database\Seeder;
use App\User;

class FirstUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = User::count();

        if ($count === 0) {
            factory(User::class)->create([
                'name' => 'MainTest',
                'email' => 'testing@ua.com',
                'password' => Hash::make( 'testing' )
            ])->each(function ($u) {
                $u->assignRole(User::ROLE_EMPLOYEE);
            });
        }
    }
}
