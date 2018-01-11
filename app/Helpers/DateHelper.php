<?php
namespace App\Helpers;

use DateTime;

class DateHelper
{
    const DATE_FORMAT_RESPONSE = 'Y/m/d';
    const DATE_FORMAT_DB = 'Y-m-d H:i:s';

    /**
     * @param string $date
     *
     * @return string
     */
    public static function getDateFormat(string $date)
    {
        switch (strlen($date)) {
            case 19:
                return self::DATE_FORMAT_DB;
            default:
                return self::DATE_FORMAT_RESPONSE;
        }
    }

    public static function dateAfterMonth(string $date)
    {
        $dateAfterMonth = DateTime::createFromFormat(
            self::getDateFormat($date),
            $date
        );

        $dateAfterMonth->modify('+1 month');

        return $dateAfterMonth->format(self::DATE_FORMAT_RESPONSE);
    }
}
