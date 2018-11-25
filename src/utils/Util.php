<?php
namespace App\Utils;

final class Util
{
    /**
     * Extract datestring to array contain [day, month, year]
     *
     * @param string $datestring
     * @return array
     */
    final public static function extractDatetime(string $datestring) : array
    {
        if (($timestamp = strtotime($datestring)) !== false) {
            return [
                'day' => date('d', $timestamp),
                'month' => date('m', $timestamp),
                'year' => date('Y', $timestamp)
            ];
        }

        return [];
    }

    /**
     * Create a date with format has formated before from day, month and year
     *
     * @param int|string $day
     * @param int|string $month
     * @param int|string $year
     * @return string
     */
    final public static function createDatetime($day, $month, $year) : string
    {
        if (($timestamp = strtotime("$year/$month/$day")) !== false) {
            return date(Constant::DATETIME_FORMAT, $timestamp);
        }

        return '';
    }

    /**
     * Compare two date.
     * Return 1 if end date bigger than start date -> valid
     * Return -1 if end date lower than start date -> not valid
     * Return 0 if start date and end date are equally
     *
     * @param string $startDate
     * @param string $endDate
     * @return void
     */
    final public static function compareTwoDate(string $startDate, string $endDate)
    {
        $startTimestamp = strtotime($startDate);
        $endTimestamp = strtotime($endDate);

        if ($startTimestamp < $endTimestamp) {
            return 1;
        } elseif ($startTimestamp > $endTimestamp) {
            return -1;
        }

        return 0;
    }

    /**
     * Compare your date with current date.
     * Return 1 if your date bigger than currrent date.
     * Return -1 if your date lower than current date
     * Return 0 if they are equally
     *
     * @param string $compareDate
     * @param string $format
     * @return void
     */
    final public static function compareWithCurrentDate(string $compareDate, string $format = Constant::DATETIME_FORMAT)
    {
        $currentDate = date($format, time());

        $compareTimestamp = strtotime($compareDate);
        $currentTimestamp = strtotime($currentDate);

        if ($compareTimestamp > $currentTimestamp) {
            return 1;
        } elseif ($compareTimestamp < $currentTimestamp) {
            return -1;
        }

        return 0;
    }
}