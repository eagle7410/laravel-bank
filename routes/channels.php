<?php
use Illuminate\Support\Facades\Broadcast;
/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

foreach ([
    'users',
    'deposits',
    'deposit-statuses',
    'deposit-actions',
         ] as $chanel) {
    Broadcast::channel($chanel, function ($user) {
        return $user;
    });
}

Broadcast::channel('user.{user}.deposits', function ($user, $userId) {
    return $user->id = $userId;
});

Broadcast::channel('user.{user}.notify', function ($user, $userId) {
    return $user->id = $userId;
});
Broadcast::channel('user.{user}.tickets', function ($user, $userId) {
    return $user->id = $userId;
});
Broadcast::channel('employee.tickets', function ($user) {
    return $user->hasRole(\App\User::ROLE_EMPLOYEE);
});
