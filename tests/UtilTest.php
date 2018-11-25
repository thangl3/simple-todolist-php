<?php
namespace Test;

use PHPUnit\Framework\TestCase;
use App\Utils\Util;

class UtilTest extends TestCase
{
    public function testSuccessExtractDate()
    {
        $startDate = Util::extractDatetime('2018-5-10');
        $endDate = Util::extractDatetime('2019-10-12');

        $this->assertEquals(
            [
                'day' => 10,
                'month' => 5,
                'year' => 2018
            ],
            $startDate
        );

        $this->assertEquals(
            [
                'day' => 12,
                'month' => 10,
                'year' => 2019
            ],
            $endDate
        );
    }

    public function testFailureExtractDate()
    {
        $startDate = Util::extractDatetime('sdsd-as-sd');
        $endDate = Util::extractDatetime('2019-13-32');

        $this->assertEquals(
            [],
            $startDate
        );

        $this->assertEquals(
            [],
            $endDate
        );
    }
}