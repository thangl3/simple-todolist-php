<?php
namespace Test;

use PHPUnit\Framework\TestCase;
use Helper\Route\Exception\NotFoundException;
use App\Utils\Constant;
use App\Controller\UpdateController;

class UpdateWorkTest extends TestCase
{
    use HelperDriverTrait;

    /**
     * Test update work is ok with valid data
     * 
     * @dataProvider dataUpdateWorkProvider
     *
     * @param array $data
     * @param array $expectedResult
     * @return void
     */
    public function testSuccessUpdateWork($data, $expectedResult)
    {
        $container = $this->mockContainer();
        $ctrl = new UpdateController($container);

        $request = $this->mockPostRequestWithParams([
            'workId' => $data['workId'],
            'workName' => $data['workName'],
            'startDate' => $data['startDate'],
            'endDate' => $data['endDate'],
            'status' => $data['status']
        ]);
        $messages = $ctrl->mockTestUpdate($request);

        $this->assertEquals(
            [
                'success' => $expectedResult['success'],
                'notify' => $expectedResult['notify'],
                'error' => $expectedResult['error']
            ],
            $messages
        );
    }

    /**
     * Test update work is fail with invalid data
     * 
     * @dataProvider dataUpdateWorkProvider
     *
     * @param array $data
     * @param array $expectedResult
     * @return void
     */
    public function testFailureUpdateWork($data, $expectedResult)
    {
        $container = $this->mockContainer();
        $ctrl = new UpdateController($container);

        $request = $this->mockPostRequestWithParams([
            'workId' => $data['workId'],
            'workName' => $data['workName'],
            'startDate' => $data['startDate'],
            'endDate' => $data['endDate'],
            'status' => $data['status']
        ]);
        $messages = $ctrl->mockTestUpdate($request);

        $this->assertEquals(
            [
                'success' => $expectedResult['success'],
                'notify' => $expectedResult['notify'],
                'error' => $expectedResult['error']
            ],
            $messages
        );
    }

    public function dataUpdateWorkProvider()
    {
        return [
            // failure case
            // 1. end date lower than today
            [
                // mock data
                [
                    'workId' => 1,
                    'workName' => 'Testing update from UnitTest',
                    'startDate' => '2018-11-13',
                    'endDate' => '2008-12-18',
                    'status' => 1
                ],
                // expected result
                [
                    'success' => null,
                    'notify' => Constant::END_DATE_LOWER_THAN_CURRENT,
                    'error' => null
                ]
            ],
            // 2. start date greate than end date
            [
                [
                    'workId' => 1,
                    'workName' => 'Testing update from UnitTest',
                    'startDate' => '2020-11-13',
                    'endDate' => '2019-12-18',
                    'status' => 1
                ],
                [
                    'success' => null,
                    'notify' => Constant::STARTDATE_BIGGER_THAN_ENDDATE,
                    'error' => null
                ]
            ],
            // 3. Invalid date
            [
                [
                    'workId' => 1,
                    'workName' => 'Testing update from UnitTest',
                    'startDate' => '',
                    'endDate' => '',
                    'status' => 1
                ],
                [
                    'success' => null,
                    'notify' => Constant::INVALID_DATE,
                    'error' => null
                ]
            ],
            // 4. invalid start date
            [
                [
                    'workId' => 1,
                    'workName' => 'Testing update from UnitTest',
                    'startDate' => '',
                    'endDate' => '2019-10-10',
                    'status' => 1
                ],
                [
                    'success' => null,
                    'notify' => Constant::INVALID_DATE,
                    'error' => null
                ]
            ],
            // 5. Invalid end date
            [
                [
                    'workId' => 1,
                    'workName' => 'Testing update from UnitTest',
                    'startDate' => '2019-10-10',
                    'endDate' => '',
                    'status' => 1
                ],
                [
                    'success' => null,
                    'notify' => Constant::INVALID_DATE,
                    'error' => null
                ]
            ],
            // 6.1 Invalid status
            [
                [
                    'workId' => 1,
                    'workName' => 'Testing update from UnitTest',
                    'startDate' => '2019-10-10',
                    'endDate' => '2019-10-10',
                    'status' => 0
                ],
                [
                    'success' => null,
                    'notify' => null,
                    'error' => Constant::UPDATE_FAIL
                ]
            ],
            // 6.2 status invalid = 4
            [
                [
                    'workId' => 1,
                    'workName' => 'Testing update from UnitTest',
                    'startDate' => '2019-10-10',
                    'endDate' => '2019-10-10',
                    'status' => 4
                ],
                [
                    'success' => null,
                    'notify' => null,
                    'error' => Constant::UPDATE_FAIL
                ]
            ],
            // 6.3 status = -1
            [
                [
                    'workId' => 1,
                    'workName' => 'Testing update from UnitTest',
                    'startDate' => '2019-10-10',
                    'endDate' => '2019-10-10',
                    'status' => -1
                ],
                [
                    'success' => null,
                    'notify' => null,
                    'error' => Constant::UPDATE_FAIL
                ]
            ],
            // success case
            // 1. start date and end date are equally
            [
                [
                    'workId' => 1,
                    'workName' => 'Testing update from UnitTest',
                    'startDate' => '2019-10-10',
                    'endDate' => '2019-10-10',
                    'status' => 1
                ],
                [
                    'success' => Constant::UPDATE_SUCCESS,
                    'notify' => null,
                    'error' => null
                ]
            ],
            // 2. start date lower than enddate one day
            [
                [
                    'workId' => 1,
                    'workName' => 'Testing update from UnitTest',
                    'startDate' => '2019-10-9',
                    'endDate' => '2019-10-10',
                    'status' => 1
                ],
                [
                    'success' => Constant::UPDATE_SUCCESS,
                    'notify' => null,
                    'error' => null
                ]
            ],
            // 3. date normal
            [
                [
                    'workId' => 1,
                    'workName' => 'Testing update from UnitTest',
                    'startDate' => '2019-10-0',
                    'endDate' => '2019-10-9',
                    'status' => 1
                ],
                [
                    'success' => Constant::UPDATE_SUCCESS,
                    'notify' => null,
                    'error' => null
                ]
            ]
        ];
    }

    /**
     * Fail if id not valid
     *
     * @return void
     */
    public function testFailureUpdateIfInvalidId()
    {
        $this->expectException(NotFoundException::class);

        $container = $this->mockContainer();
        $ctrl = new UpdateController($container);

        $request = $this->mockPostRequestWithParams([
            'workId' => 'asdd'
        ]);
        $ctrl->mockTestUpdate($request);
    }

    /**
     * Fail if id is empty
     *
     * @return void
     */
    public function testFailureUpdateIfEmptyId()
    {
        $this->expectException(NotFoundException::class);

        $container = $this->mockContainer();
        $ctrl = new UpdateController($container);

        $request = $this->mockPostRequestWithParams([
            'workId' => ''
        ]);
        $ctrl->mockTestUpdate($request);
    }

    /**
     * Fail if if not has on server
     *
     * @return void
     */
    public function testFailureUpdateIfNotHasId()
    {
        $this->expectException(NotFoundException::class);

        $container = $this->mockContainer();
        $ctrl = new UpdateController($container);

        $request = $this->mockPostRequestWithParams([
            'workId' => '1000'
        ]);
        $ctrl->mockTestUpdate($request);
    }

    /**
     * Can update status with true data
     *
     * @return void
     */
    public function testSuccessUpdateStatusOfWork()
    {
        $container = $this->mockContainer();
        $request = $this->mockPostRequestWithParams([
            'id' => rand(1, 16),
            'status' => 1
        ]);

        $ctrl = new UpdateController($container);
        $response = $ctrl->updateStatus($request, $container->response);

        $this->assertJsonStringEqualsJsonString(
            json_encode([
                'message' => Constant::UPDATE_STATUS_SUCCESS
            ]),
            $response->getBody()
        );
    }

    /**
     * Fail if update with status not has in range (1-3)
     *
     * @return void
     */
    public function testFailureUpdateStatusOfWorkIfStatusNotHas()
    {
        $container = $this->mockContainer();
        $request = $this->mockPostRequestWithParams([
            'id' => rand(3, 29),
            'status' => 4
        ]);

        $ctrl = new UpdateController($container);
        $response = $ctrl->updateStatus($request, $container->response);

        $this->assertJsonStringEqualsJsonString(
            json_encode([
                'message' => Constant::UPDATE_STATUS_FAIL
            ]),
            $response->getBody()
        );
    }

    /**
     * Fail if status is string
     *
     * @return void
     */
    public function testFailureUpdateStatusIfStatusInvalid()
    {
        $container = $this->mockContainer();
        $request = $this->mockPostRequestWithParams([
            'id' => rand(3, 29),
            'status' => 'asd'
        ]);

        $ctrl = new UpdateController($container);
        $response = $ctrl->updateStatus($request, $container->response);

        $this->assertJsonStringEqualsJsonString(
            json_encode([
                'message' => Constant::UPDATE_STATUS_FAIL
            ]),
            $response->getBody()
        );
    }

    /**
     * Test NotFoundException will throw if not has id
     *
     * @return void
     */
    public function testExceptionUpdateStatusIfNotHasId()
    {
        $this->expectException(NotFoundException::class);

        $container = $this->mockContainer();
        $ctrl = new UpdateController($container);

        $request = $this->mockPostRequestWithParams([
            'workId' => '1000'
        ]);
        $ctrl->updateStatus($request, $container->response);
    }

    /**
     * Test NotFoundException will throw if id is empty
     *
     * @return void
     */
    public function testExceptionUpdateStatusIfEmptyId()
    {
        $this->expectException(NotFoundException::class);

        $container = $this->mockContainer();
        $ctrl = new UpdateController($container);

        $request = $this->mockPostRequestWithParams([
            'workId' => ''
        ]);
        $ctrl->updateStatus($request, $container->response);
    }

    /**
     * Test NotFoundException will throw if id is invalid
     *
     * @return void
     */
    public function testExceptionUpdateStatusIfInvalidId()
    {
        $this->expectException(NotFoundException::class);

        $container = $this->mockContainer();
        $ctrl = new UpdateController($container);

        $request = $this->mockPostRequestWithParams([
            'workId' => '1asd'
        ]);
        $ctrl->updateStatus($request, $container->response);
    }
}