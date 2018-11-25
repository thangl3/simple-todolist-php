<?php
namespace App\Utils;

class Constant
{
    const DATETIME_FORMAT = 'Y-m-d';
    const CREATE_SUCCESS = 'Create a work success!';
    const CREATE_FAIL = 'Create a work fail!';
    const UPDATE_SUCCESS = 'Update the work success!';
    const UPDATE_FAIL = 'Update the work fail!';
    const DELETE_SUCCESS = 'Delete a work success!';
    const DELETE_FAIL = 'Delete a work fail!';
    const STARTDATE_NOT_VALID = 'Start date not valid, please try again!';
    const ENDDATE_NOT_VALID = 'End date not valid, please try again!';
    const UPDATE_STATUS_SUCCESS = 'Update status success!';
    const UPDATE_STATUS_FAIL = 'Update status fail!';
    const STARTDATE_BIGGER_THAN_ENDDATE = 'Please choose start date lower than or equal with the end date';
    const END_DATE_LOWER_THAN_CURRENT = 'Please choose the end date lower or equal with today';
    const INVALID_WORKNAME = 'Please enter the work name';
}