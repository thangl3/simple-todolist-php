<?php
namespace App\Utils;

final class Util
{
    final public static function extractDatetime(string $datestring)
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

    final public static function createDatetime($day, $month, $year) : string
    {
        if (($timestamp = strtotime("$year/$month/$day")) !== false) {
            return date(Constant::DATETIME_FORMAT, $timestamp);
        }

        return '';
    }
}