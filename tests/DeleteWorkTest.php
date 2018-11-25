<?php
namespace Test;

use PHPUnit\Framework\TestCase;
use App\Utils\Constant;
use App\Controller\DeleteController;
use Helper\Route\Exception\NotFoundException;

class DeleteWorkTest extends TestCase
{
    use HelperDriverTrait;

    /**
     * Test delete work success
     * You must edit id and it has on database -> it could be ok when running testing
     *
     * @return void
     */
    public function testSuccessDeleteWork()
    {
        $container = $this->mockContainer();
        $request = $this->mockPostRequestWithParams([
            'id' => rand(1, 16)
        ]);

        $ctrl = new DeleteController($container);
        $response = $ctrl->deleteWork($request, $container->response);

        $this->assertJsonStringEqualsJsonString(
            json_encode([
                'message' => Constant::DELETE_SUCCESS
            ]),
            $response->getBody()
        );
    }

    /**
     * Fail if ID is empty
     *
     * @return void
     */
    public function testFailureDeleteWorkIfEmptyId()
    {
        $this->expectException(NotFoundException::class);

        $container = $this->mockContainer();
        $request = $this->mockPostRequestWithParams([
            'id' => ''
        ]);

        $ctrl = new DeleteController($container);
        $ctrl->deleteWork($request, $container->response);
    }

    /**
     * Fail if ID is not valid
     * id: asdasd, null ...
     *
     * @return void
     */
    public function testFailureDeleteWorkIfInvalidId()
    {
        $this->expectException(NotFoundException::class);

        $container = $this->mockContainer();
        $request = $this->mockPostRequestWithParams([
            'id' => 'asdasd'
        ]);

        $ctrl = new DeleteController($container);
        $ctrl->deleteWork($request, $container->response);
    }

    /**
     * Fail if Id not has on database
     *
     * @return void
     */
    public function testFailureDeleteWorkIfNotHasId()
    {
        $this->expectException(NotFoundException::class);

        $container = $this->mockContainer();
        $request = $this->mockPostRequestWithParams([
            'id' => '10000'
        ]);

        $ctrl = new DeleteController($container);
        $ctrl->deleteWork($request, $container->response);
    }
}