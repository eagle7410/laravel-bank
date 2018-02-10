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

            $user = User::create([
                'name' => 'MainTest',
                'email' => 'testing@ua.com',
                'password' => Hash::make( 'testing' )
            ]);
            $user->assignRole(User::ROLE_EMPLOYEE);
            $user->save();

            $user = User::create([
                'name' => 'system',
                'email' => User::SYSTEM_USER_EMAIL,
                'password' => Hash::make( 'system' )
            ]);
            $user->assignRole(User::ROLE_SYSTEM);
            $user->save();
        }
    }
}
