<?php
namespace Test;

use PHPUnit\Framework\TestCase;
use App\Utils\Constant;
use App\Controller\CreateController;

class CreateWorkTest extends TestCase
{
    use HelperDriverTrait;

    /**
     * Test create a work success
     *
     * @return void
     */
    public function testSuccessCreateAWork()
    {
        $container = $this->mockContainer();
        $createCtrl = new CreateController($container);

        $request = $this->mockPostRequestWithParams([
            'workName' => 'Testing insert from UnitTest',
            'startDate' => '2018-11-13',
            'endDate' => '2019-12-18'
        ]);
        $messages = $createCtrl->mockTestCreate($request);

        $this->assertEquals(
            [
                'success' => Constant::CREATE_SUCCESS,
                'notify' => null,
                'error' => null
            ],
            $messages
        );
    }

    /**
     * Test can not insert if work name is empty or invalid
     *
     * @return void
     */
    public function testFailureCreateAWorkIfInvalidName()
    {
        $container = $this->mockContainer();
        $createCtrl = new CreateController($container);

        $request = $this->mockPostRequestWithParams([
            'workName' => '',
            'startDate' => '2018-11-13',
            'endDate' => '2019-12-18'
        ]);
        $messages = $createCtrl->mockTestCreate($request);

        $this->assertEquals(
            [
                'success' => null,
                'notify' => Constant::INVALID_WORKNAME
            ],
            [
                'success' => $messages['success'],
                'notify' => $messages['notify']
            ]
        );
    }

    /**
     * Can not inserting if the end date is lower than today
     *
     * @return void
     */
    public function testFailureCreateAWorkIfEndDateLowerThanToday()
    {
        $container = $this->mockContainer();
        $createCtrl = new CreateController($container);

        $request = $this->mockPostRequestWithParams([
            'workName' => 'Test',
            'startDate' => '2019-11-13',
            'endDate' => '2017-12-18'
        ]);

        $messages = $createCtrl->mockTestCreate($request);

        $this->assertEquals(
            [
                'success' => null,
                'notify' => Constant::END_DATE_LOWER_THAN_CURRENT
            ],
            [
                'success' => $messages['success'],
                'notify' => $messages['notify']
            ]
        );
    }

    /**
     * Can not inserting if start date is greater than end date
     *
     * @return void
     */
    public function testFailureCreateAWorkIfStartGreaterThanEndDate()
    {
        $container = $this->mockContainer();
        $createCtrl = new CreateController($container);

        $request = $this->mockPostRequestWithParams([
            'workName' => 'Test',
            'startDate' => '2019-11-13',
            'endDate' => '2019-10-10'
        ]);

        $messages = $createCtrl->mockTestCreate($request);

        $this->assertEquals(
            [
                'success' => null,
                'notify' => Constant::STARTDATE_BIGGER_THAN_ENDDATE
            ],
            [
                'success' => $messages['success'],
                'notify' => $messages['notify']
            ]
        );
    }

    /**
     * CAn not insert because empty data
     *
     * @return void
     */
    public function testFailureCreateAWorkIfEmptyData()
    {
        $container = $this->mockContainer();
        $createCtrl = new CreateController($container);

        $request = $this->mockPostRequestWithParams([
            'workName' => '',
            'startDate' => '',
            'endDate' => ''
        ]);
        $messages = $createCtrl->mockTestCreate($request);

        $this->assertEquals(
            [
                'success' => null,
                'notify' => Constant::INVALID_DATE,
                'error' => null
            ],
            $messages
        );
    }

    /**
     * Can not insert because invalid data
     *
     * @return void
     */
    public function testFailureCreateAWorkIfNotValidData()
    {
        $container = $this->mockContainer();
        $createCtrl = new CreateController($container);

        $request = $this->mockPostRequestWithParams([
            'workName' => '',
            'startDate' => 'asds-sd-10',
            'endDate' => '2019-sd-12'
        ]);
        $messages = $createCtrl->mockTestCreate($request);

        $this->assertEquals(
            [
                'success' => null,
                'notify' => Constant::INVALID_DATE,
                'error' => null
            ],
            $messages
        );
    }

    /**
     * Can not insert because invalid date
     *
     * @return void
     */
    public function testFailureCreateAWorkIfNotValidDate()
    {
        $container = $this->mockContainer();
        $createCtrl = new CreateController($container);

        $request = $this->mockPostRequestWithParams([
            'workName' => 'Test',
            'startDate' => 'asds-sd-10',
            'endDate' => '2019-sd-12'
        ]);
        $messages = $createCtrl->mockTestCreate($request);

        $this->assertEquals(
            [
                'success' => null,
                'notify' => Constant::INVALID_DATE,
                'error' => null
            ],
            $messages
        );
    }

    /**
     * Test return message if the start date is greater then the end date 
     *
     * @return void
     */
    public function testTrueStartGreaterThanEndDate()
    {
        $createCtrl = new CreateController($this->mockContainer());

        $this->assertTrue($createCtrl->isStartDateGreaterThanEndDate('2019-11-11', '2019-11-10'));
        $this->assertTrue($createCtrl->isStartDateGreaterThanEndDate('2019-11-11', '2019-11-10'));
        $this->assertTrue($createCtrl->isStartDateGreaterThanEndDate('2019-11-12', '2019-11-10'));
        $this->assertFalse($createCtrl->isStartDateGreaterThanEndDate('2018-11-10', '2019-11-10'));
        $this->assertFalse($createCtrl->isStartDateGreaterThanEndDate('2019-11-09', '2019-11-11'));
    }

    /**
     * Test whether enday lower than today working?
     *
     * @return void
     */
    public function testTrueIfEndDateLowerThanToday()
    {
        $createCtrl = new CreateController($this->mockContainer());

        $this->assertTrue($createCtrl->isEndDateLowerThanToday('2018-11-13'));
        $this->assertTrue($createCtrl->isEndDateLowerThanToday('2018-11-10'));
        $this->assertFalse($createCtrl->isEndDateLowerThanToday('2019-11-10'));
    }

    /**
     * Test start date and end date is valid
     *
     * @return void
     */
    public function testTrueIfStartAndEndDateNotValid()
    {
        $createCtrl = new CreateController($this->mockContainer());

        $this->assertTrue($createCtrl->isNotValidStartAndEndDate('', ''));
        $this->assertTrue($createCtrl->isNotValidStartAndEndDate('1234-32-32', 'asds-fd-aa'));
        $this->assertTrue($createCtrl->isNotValidStartAndEndDate('12-13-1234', '13-13-2010'));
        $this->assertFalse($createCtrl->isNotValidStartAndEndDate('2010-10-10', '1999-12-11'));
    }

    /**
     * Test invalid only start day
     *
     * @return void
     */
    public function testTrueIfStartDateNotValid()
    {
        $createCtrl = new CreateController($this->mockContainer());

        $this->assertTrue($createCtrl->isNotValidStartAndEndDate('', '2019-11-13'));
        $this->assertTrue($createCtrl->isNotValidStartAndEndDate('abc', '2019-11-10'));
        $this->assertTrue($createCtrl->isNotValidStartAndEndDate('2011-13-32', '2019-11-10'));
        $this->assertTrue($createCtrl->isNotValidStartAndEndDate('2019-11-aa', '2019-11-10'));
        $this->assertTrue($createCtrl->isNotValidStartAndEndDate('2019-ss-10', '2019-11-10'));
        $this->assertTrue($createCtrl->isNotValidStartAndEndDate('ssaa-11-10', '2019-11-10'));
        $this->assertTrue($createCtrl->isNotValidStartAndEndDate('agsf-2w-1o', '2019-11-10'));
        $this->assertFalse($createCtrl->isNotValidStartAndEndDate('2019-11-10', '2019-11-10'));
    }

    /**
     * Test invalid only end date
     *
     * @return void
     */
    public function testTrueIfEndDateNotValid()
    {
        $createCtrl = new CreateController($this->mockContainer());

        $this->assertTrue($createCtrl->isNotValidStartAndEndDate('2019-11-13', ''));
        $this->assertTrue($createCtrl->isNotValidStartAndEndDate('2019-11-13', 'abc'));
        $this->assertTrue($createCtrl->isNotValidStartAndEndDate('2019-11-13', '2011-13-32'));
        $this->assertTrue($createCtrl->isNotValidStartAndEndDate('2019-11-13', '2019-11-aa'));
        $this->assertTrue($createCtrl->isNotValidStartAndEndDate('2019-11-13', '2019-ss-10'));
        $this->assertTrue($createCtrl->isNotValidStartAndEndDate('2019-11-13', 'ssaa-11-10'));
        $this->assertTrue($createCtrl->isNotValidStartAndEndDate('2019-11-13', 'agsf-2w-1o'));
        $this->assertFalse($createCtrl->isNotValidStartAndEndDate('2019-11-10', '2019-11-10'));
    }

    /**
     * Test workname is invalid ?
     *
     * @return void
     */
    public function testTrueIfWorkNameNotValid()
    {
        $createCtrl = new CreateController($this->mockContainer());

        $this->assertTrue($createCtrl->isNotValidWorkName(''));
        $this->assertTrue($createCtrl->isNotValidWorkName(null));
    }

    /**
     * Test work name valid
     *
     * @return void
     */
    public function testTrueIfWorkNameValid()
    {
        $createCtrl = new CreateController($this->mockContainer());

        $this->assertFalse($createCtrl->isNotValidWorkName('Hello'));
        $this->assertFalse($createCtrl->isNotValidWorkName('1'));
    }
}