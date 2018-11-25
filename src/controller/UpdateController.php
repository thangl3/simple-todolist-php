<?php
namespace App\Controller;

use Exception;
use Helper\Route\Http\RequestInterface as Request;
use Helper\Route\Http\ResponseInterface as Response;
use App\Utils\Constant;
use App\Utils\Util;
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

            $canCreateWork = true;

            $workName = $request->getBodyParam('workName');
            $startDate = $request->getBodyParam('startDate');
            $endDate = $request->getBodyParam('endDate');
            $status = $request->getBodyParam('status');

            // if (Util::compareTwoDate($startDate, $endDate) >= 0) {
            //     if (Util::compareWithCurrentDate($endDate) >= 0) {
            //         $canCreateWork = true;
            //     } else {
            //         $notify = Constant::END_DATE_LOWER_THAN_CURRENT;
            //     }
            // } else {
            //     $notify = Constant::STARTDATE_BIGGER_THAN_ENDDATE;
            // }

            if (!$workName) {
                $notify = Constant::INVALID_WORKNAME;
                $canCreateWork = false;
            }

            if ($canCreateWork) {
                $isSuccess = $workBo->updateWork([
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
            }
        }

        $status = $statusBo->getStatuses();
        $work = $workBo->getWorkById($workId);

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
        $message = null;
        $workId = $request->getBodyParam('id');
        $status = $request->getBodyParam('status');
        $workBo = new WorkBO($this->c->db);

        if ($workBo->hasWork($workId)) {
            $isSuccess = $workBo->updateStatus([
                'workId' => $workId,
                'status' => $status
            ]);

            if ($isSuccess) {
                $message = Constant::UPDATE_STATUS_SUCCESS;
            } else {
                $message = Constant::UPDATE_STATUS_FAIL;
            }
        } else {
            $message = Constant::UPDATE_STATUS_FAIL;
        }

        return $response->withJson(json_encode(['message' => $message]));
    }
}