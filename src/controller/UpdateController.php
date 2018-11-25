<?php
namespace App\Controller;

use Exception;
use Helper\Route\Http\RequestInterface as Request;
use Helper\Route\Http\ResponseInterface as Response;
use Helper\Route\Exception\NotFoundException;
use App\Utils\Constant;
use App\Utils\Util;
use App\Model\BO\WorkBO;
use App\Model\BO\StatusBO;

class UpdateController extends Controller
{
    use ValidaterFormTrait;

    /**
     * Name of function must be mapping with call router
     * Controller when user access update page and update a work
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function updateWork(Request $request, Response $response) : Response
    {
        $workId = (int) $request->getParam('id');

        $workBo = new WorkBO($this->c->db);
        if (!$workBo->hasWork($workId)) {
            throw new NotFoundException($request, $response);
        }

        $success = null;
        $error = null;
        $notify = null;
        
        // Request with POST method
        if ($request->isPost()) {
            $validate = $this->validateForm($request->getBodyParams());
            $notify = $validate['message'];

            if ($validate['isOk']) {
                $safeVariable = $validate['safeVar'];

                $isSuccess = $workBo->updateWork([
                    'workId' => $safeVariable['workId'],
                    'workName' => $safeVariable['workName'],
                    'startDate' => $safeVariable['startDate'],
                    'endDate' => $safeVariable['endDate'],
                    'status' => $safeVariable['status']
                ]);

                if ($isSuccess) {
                    $success = Constant::UPDATE_SUCCESS;
                } else {
                    $error = Constant::UPDATE_FAIL;
                }
            }
        }

        $statusBo = new StatusBO();
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

    /**
     * Name of function must be mapping with call router
     * Just update status via XHR
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function updateStatus(Request $request, Response $response) : Response
    {
        $message = null;
        $workId = (int) $request->getBodyParam('id');
        $status = (int) $request->getBodyParam('status');
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
            throw new NotFoundException($request, $response);
        }

        return $response->withJson(json_encode(['message' => $message]));
    }

    /**
     * For testing
     *
     * @param Request $request
     * @return void
     */
    public function mockTestUpdate($request)
    {
        $success = null;
        $error = null;
        $workId = (int) $request->getParam('workId');
        $workBo = new WorkBO($this->c->db);

        if (!$workBo->hasWork($workId)) {
            throw new NotFoundException($this->c->request, $this->c->response);
        }

        $validate = $this->validateForm($request->getBodyParams());

        if ($validate['isOk']) {
            $safeVariable = $validate['safeVar'];

            $isSuccess = $workBo->updateWork([
                'workId' => $safeVariable['workId'],
                'workName' => $safeVariable['workName'],
                'startDate' => $safeVariable['startDate'],
                'endDate' => $safeVariable['endDate'],
                'status' => $safeVariable['status']
            ]);

            if ($isSuccess) {
                $success = Constant::UPDATE_SUCCESS;
            } else {
                $error = Constant::UPDATE_FAIL;
            }
        }

        return [
            'success'   => $success,
            'notify'    => $validate['message'],
            'error'     => $error
        ];
    }
}