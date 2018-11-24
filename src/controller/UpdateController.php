<?php
namespace App\Controller;

use Exception;
use Helper\Route\Http\RequestInterface as Request;
use Helper\Route\Http\ResponseInterface as Response;
use App\Utils\Constant;
use App\Model\BO\WorkBO;
use App\Model\BO\StatusBO;

class UpdateController extends Controller
{
    public function updateWork(Request $request, Response $response) : Response
    {
        $workId = (int) $request->getParam('id');
        $statusBo = new StatusBO();
        $workBo = new WorkBO($this->c->db);

        $success = null;
        $error = null;
        $notify = null;
        
        // Request with POST method
        if ($request->isPost()) {
            if (!$workBo->hasWork($workId)) {
                throw new Exception('Not found');
            }

            $workName = $request->getBodyParam('workName');
            $startDate = $request->getBodyParam('startDate');
            $endDate = $request->getBodyParam('endDate');
            $status = $request->getBodyParam('status');

            if ($statusBo->isValidStatus($status)) {
                $isSuccess = $workBo->update([
                    'workId' => $workId,
                    'workName' => $workName,
                    'startDate' => $startDate,
                    'endDate' => $endDate,
                    'status' => $status
                ]);

                if ($isSuccess) {
                    $success = Constant::UPDATE_SUCCESS;
                } else {
                    $error = Constant::UPDATE_FAIL;
                }
            } else {
                $notify = Constant::STATUS_NOT_VALID;
            }
        }

        $work = $workBo->selectById($workId);
        $status = $statusBo->getAll();

        return $this->c->view->render(
            $response,
            'update.html.php',
            [
                'work'      => $work,
                'status'    => $status,
                'success'   => $success,
                'notify'    => $notify,
                'error'     => $error
            ]
        );
    }

    public function updateStatus(Request $request, Response $response) : Response
    {
        if ($request->isGet()) {
            $message = null;
            $workId = $request->getQueryParam('id');
            $status = $request->getQueryParam('status');
            $workBo = new WorkBO($this->c->db);

            if ($workBo->hasWork($workId)) {
                $isSuccess = $workBo->updateStatus([
                    'workId' => $workId,
                    'status' => $status
                ]);
    
                if ($isSuccess) {
                    $message = Constant::UPDATE_STATUS_SUCCESS;
                    return $response->redirectTo('/');
                } else {
                    $message = Constant::UPDATE_STATUS_FAIL;
                }
            } else {
                $message = Constant::UPDATE_STATUS_FAIL;
            }

            return $response->withJson(json_encode(['message' => $message]));
        }

        return $response;
    }
}