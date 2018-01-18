<?php

namespace App\Models\Profiles;

use App\User;
use Illuminate\Support\Facades\Auth;

class Profile extends ProfileBase
{
    /**
     * @param array $data
     *
     * @return Deposits
     */
    protected function create(array $data)
    {
        $data['user_id'] = $data['user_id'] ?? Auth::id();

        $profile = Profile::where('user_id', $data['user_id'])->first();

        if (empty($profile)) {
            $profile = new Profile();
        }

        $profile->fill($data);

        if (Auth()->user()->hasRole(User::ROLE_CLIENT)) {
            $profile->post = 'Client';
        }

        $profile->save();

        return $profile;
    }
}
