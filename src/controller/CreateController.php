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
        $isCreated = false;

        if ($request->isPost()) {
            $validate = $this->validateForm($request->getBodyParams());
            $message = $validate['message'];

            if ($validate['isOk']) {
                $workBo = new WorkBO($this->c->db);
                $safeVariable = $validate['safeVar'];

                $latestId = $workBo->createWork([
                    'workName' => $safeVariable['workName'],
                    'startDate' => $safeVariable['startDate'],
                    'endDate' => $safeVariable['endDate']
                ]);

                if ($latestId > 0) {
                    $message = Constant::CREATE_SUCCESS;
                    $isCreated = true;
                } else {
                    $message = Constant::CREATE_FAIL;
                }
            }

            $json = json_encode([
                'result' => $isCreated,
                'message' => $message
            ]);

            return $response->withJson($json);
        }

        return $this->c->view->render(
            $response,
            'create.html.php',
            [
                'success'   => $success,
                'notify'    => $notify,
                'error'     => $error
            ]
        );
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