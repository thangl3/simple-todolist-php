<?php
namespace App\Controller;

use Helper\Route\Http\RequestInterface as Request;
use Helper\Route\Http\ResponseInterface as Response;
use App\Utils\Constant;
use App\Model\BO\WorkBO;

class CreateController extends Controller
{
    public function createWork(Request $request, Response $response) : Response
    {
        $success = null;
        $error = null;
        $notify = null;

        if ($request->isPost()) {
            $workBo = new WorkBO($this->c->db);

            $latestId = $workBo->create([
                'workName' => $request->getBodyParam('workName'),
                'startDate' => $request->getBodyParam('startDate'),
                'endDate' => $request->getBodyParam('endDate')
            ]);

            if ($latestId > 0) {
                $success = Constant::CREATE_SUCCESS;
            } else {
                $error = Constant::CREATE_FAIL;
            }
        }

        return $this->c->view->render(
            $response,
            'create.html.php',
            [
                'success' => $success,
                'notify' => $notify,
                'error' => $error
            ]
        );
    }
}