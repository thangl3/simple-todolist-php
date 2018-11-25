<?php
namespace App\Controller;

use Helper\Route\Http\RequestInterface as Request;
use Helper\Route\Http\ResponseInterface as Response;
use App\Utils\Constant;
use App\Model\BO\WorkBO;

class CreateController extends Controller
{
    use ValidaterFormTrait;

    public function createWork(Request $request, Response $response) : Response
    {
        $success = null;
        $error = null;
        $notify = null;

        if ($request->isPost()) {
            $validate = $this->validateForm($request->getBodyParams());
            $notify = $validate['message'];

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
     * @param [type] $request
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