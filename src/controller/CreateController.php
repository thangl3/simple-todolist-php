<?php
namespace App\Controller;

use Helper\Route\Http\RequestInterface as Request;
use Helper\Route\Http\ResponseInterface as Response;
use App\Utils\Constant;
use App\Utils\Util;
use App\Model\BO\WorkBO;

class CreateController extends Controller
{
    public function createWork(Request $request, Response $response) : Response
    {
        $success = null;
        $error = null;
        $notify = null;

        if ($request->isPost()) {
            $canCreateWork = false;

            $workName = $request->getBodyParam('workName');
            $startDate = $request->getBodyParam('startDate');
            $endDate = $request->getBodyParam('endDate');

            if (Util::compareTwoDate($startDate, $endDate) >= 0) {
                if (Util::compareWithCurrentDate($endDate) >= 0) {
                    $canCreateWork = true;
                } else {
                    $notify = Constant::END_DATE_LOWER_THAN_CURRENT;
                }
            } else {
                $notify = Constant::STARTDATE_BIGGER_THAN_ENDDATE;
            }

            if (!$workName) {
                $notify = Constant::INVALID_WORKNAME;
                $canCreateWork = false;
            }

            if ($canCreateWork) {
                $workBo = new WorkBO($this->c->db);

                $latestId = $workBo->createWork([
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