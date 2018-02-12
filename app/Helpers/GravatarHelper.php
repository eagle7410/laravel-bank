<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 12.02.18
 * Time: 1:15
 */

namespace App\Helpers;

class GravatarHelper
{
    const BASE_URL = 'https://www.gravatar.com/avatar/';

    public static function getUrl(
        string $email,
        int    $s = 80,
        string $d = 'retro',
        string $r = 'g'
    ): string {
        return self::BASE_URL . md5(strtolower(trim($email))) . "?s=$s&d=$d&r=$r";
    }

}
