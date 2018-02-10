<?php

namespace App;

use DateTime;
use App\Events\UserAddDepositIncomeEvent;
use App\Helpers\DateHelper;
use App\Models\Profiles\ProfileBase;
use App\Notifications\AddIncome;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notification;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    const ROLE_EMPLOYEE = 'employee';
    const ROLE_CLIENT   = 'client';
    const ROLE_SYSTEM   = 'system';
    const SYSTEM_USER_EMAIL = 'system@ua.com';

    use Notifiable;
    use HasRoles;

    private $profileCache = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Profile()
    {
        return $this->hasOne(ProfileBase::class);
    }

    public function name_first(): string
    {
        return $this->getProfileProp('name_first');
    }

    public function name_last(): string
    {
        return $this->getProfileProp('name_last');
    }

    public function desc(): string
    {
        return $this->getProfileProp('desc');
    }
    
    public function post(): string
    {
        $post = $this->getProfileProp('post');

        if (empty($post)) {
            $post = $this->hasRole(self::ROLE_EMPLOYEE) ? 'Not assigned' : 'Client';
        }

        return $post;
    }

    public static function getSystemUser() : User
    {
        return self::where(['email' => self::SYSTEM_USER_EMAIL])->first();
    }

    public function member(): string
    {
        return DateHelper::dateStringToMemberFormat($this->created_at);
    }

    public function sendNotifyIncome($data)
    {
        foreach ($data as $item)
        {
            $notify = new AddIncome($item);
            $this->notify($notify);
            event(new UserAddDepositIncomeEvent($this, $this->lastNotify()));
        }
    }

    /**
     * Get the entity's read notifications.
     */
    public function lastNotify()
    {
        return $this->notifications()->first();
    }

    private function getProfileProp(string $prop)
    {
        $this->getProfile();

        return $this->profileCache->{$prop} ;
    }

    private function getProfile()
    {
        if (!empty($this->profileCache)) {
            return;
        }

        $this->profileCache = $this->profile;

        if (empty($this->profileCache)) {
            $isEmployee = $this->hasRole(self::ROLE_EMPLOYEE);

            $this->profileCache = (object) [
                'post' => $isEmployee ? 'Not assigned' : 'Client',
                'name_last' => $isEmployee ? 'Employee' : 'Client',
                'name_first' => 'Dear',
                'desc' => ''
            ];
        }
    }
}
