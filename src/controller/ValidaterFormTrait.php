<?php
namespace App\Controller;

use App\Utils\Constant;
use App\Utils\Util;

trait ValidaterFormTrait
{
    public function validateForm(array $params)
    {
        $isOk = false;
        $message = null;

        $workName = $params['workName'];
        $startDate = $params['startDate'];
        $endDate = $params['endDate'];

        // TODO - filter params for prevent the XSS attack

        if ($this->isNotValidStartAndEndDate($startDate, $endDate)) {
            $message = Constant::INVALID_DATE;
            $isOk = false;
        } elseif ($this->isEndDateLowerThanToday($endDate)) {
            $message = Constant::END_DATE_LOWER_THAN_CURRENT;
            $isOk = false;
        } elseif ($this->isStartDateGreaterThanEndDate($startDate, $endDate)) {
            $message = Constant::STARTDATE_BIGGER_THAN_ENDDATE;
            $isOk = false;
        } elseif ($this->isNotValidWorkName($workName)) {
            $message = Constant::INVALID_WORKNAME;
            $isOk = false;
        } else {
            $isOk = true;
        }

        return [
            'isOk' => $isOk,
            'safeVar' => $params,
            'message' => $message
        ];
    }

    /**
     * Check not valid work name.
     * If valid, Return NULL
     * else return `text message`
     * 
     * Set to public because need to using this function in UnitTest
     *
     * @param mixed $workName
     * @return void
     */
    public function isNotValidWorkName($workName)
    {
        if (!$workName) {
            return true;
        }

        return false;
    }

    /**
     * Check not valid start and end date.
     * If valid, Return NULL
     * else return `text message`
     * 
     * Set to public because need to using this function in UnitTest
     *
     * @param mixed $startDate
     * @param mixed $endDate
     * @return void
     */
    public function isNotValidStartAndEndDate($startDate, $endDate)
    {
        if (Util::isWrongDateFormat($startDate) || Util::isWrongDateFormat($endDate)) {
            return true;
        }

        return false;
    }

    public function isStartDateGreaterThanEndDate($startDate, $endDate)
    {
        if (Util::compareTwoDate($startDate, $endDate) >= 0) {
            return false;
        }

        return true;
    }

    public function isEndDateLowerThanToday($endDate)
    {
        if (Util::compareWithCurrentDate($endDate) >= 0) {
            return false;
        } else {
            return true;
        }
    }
}