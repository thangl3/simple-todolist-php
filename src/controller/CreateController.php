<?php
namespace App\Controller;

use Helper\Route\Http\RequestInterface as Request;
use Helper\Route\Http\ResponseInterface as Response;
use App\Utils\Constant;
use App\Model\BO\WorkBO;

class CreateController extends Controller
{
    use ValidaterFormTrait;

    /**
     * Name of function must be mapping with call router
     * Control display page or create a work
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function createWork(Request $request, Response $response) : Response
    {
        $message = null;
        $isSuccess = false;
        $dataInserted = null;

        $validate = $this->validateForm($request->getBodyParams());
        $message = $validate['message'];

        if ($validate['isOk']) {
            $workBo = new WorkBO($this->c->db);
            $safeVariable = $validate['safeVariable'];

            $latestId = $workBo->createWork([
                'workName' => $safeVariable['workName'],
                'startDate' => $safeVariable['startDate'],
                'endDate' => $safeVariable['endDate']
            ]);

            if ($latestId > 0) {
                $message = Constant::CREATE_SUCCESS;
                $isSuccess = true;
                $dataInserted = [
                    'workId' => $latestId,
                    'workName' => $safeVariable['workName'],
                    'startDate' => $safeVariable['startDate'],
                    'endDate' => $safeVariable['endDate'],
                    'status' => 1
                ];
            } else {
                $message = Constant::CREATE_FAIL;
            }
        }

        $json = json_encode([
            'result' => $isSuccess,
            'message' => $message,
            'data' => $dataInserted
        ]);

        return $response->withJson($json);
    }

    /**
     * For testing about create a work
     *
     * @param Request $request
     * @return void
     */
    public function mockTestCreate($request)
    {
        $success = null;
        $error = null;

        $validate = $this->validateForm($request->getBodyParams());

        if ($validate['isOk']) {
            $workBo = new WorkBO($this->c->db);
            $safeVariable = $validate['safeVar'];

            $latestId = $workBo->createWork([
                'workName' => $safeVariable['workName'],
                'startDate' => $safeVariable['startDate'],
                'endDate' => $safeVariable['endDate']
            ]);

            if ($latestId > 0) {
                $success = Constant::CREATE_SUCCESS;
            } else {
                $error = Constant::CREATE_FAIL;
            }
        }

        return [
            'success'   => $success,
            'notify'    => $validate['message'],
            'error'     => $error
        ];
    }
}