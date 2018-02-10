<?php
namespace App\Helpers;

use DateTime;

class DateHelper
{
    const DATE_FORMAT_RESPONSE = 'Y/m/d';
    const DATE_FORMAT_SHOW = 'd-m-Y';
    const DATE_FORMAT_DB = 'Y-m-d H:i:s';
    const DATE_FORMAT_MEMBER = 'M. Y';

    public static function nowForDb()
    {
        $now = new DateTime();
        return $now->format(self::DATE_FORMAT_DB);
    }

    /**
     * @param string $date
     *
     * @return string
     */
    public static function dateStringToMemberFormat(string $date)
    {
        return self::getDateTimeFromString($date)->format(self::DATE_FORMAT_MEMBER);
    }

    /**
     * @param string $date
     *
     * @return string
     */
    public static function dateStringToShowFormat(string $date)
    {
        return self::getDateTimeFromString($date)->format(self::DATE_FORMAT_SHOW);
    }

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

    public static function getDateTimeFromString(string $date): DateTime
    {
        return DateTime::createFromFormat(
            self::getDateFormat($date),
            $date
        );
    }

    public static function dateAfterMonth(string $date)
    {
        $dateAfterMonth = self::getDateTimeFromString($date);

        $dateAfterMonth->modify('+1 month');

        return $dateAfterMonth->format(self::DATE_FORMAT_RESPONSE);
    }

}
