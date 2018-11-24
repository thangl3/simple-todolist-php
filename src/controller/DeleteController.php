<?php
namespace App\Controller;

use Helper\Route\Http\RequestInterface as Request;
use Helper\Route\Http\ResponseInterface as Response;
use App\Utils\Constant;
use App\Model\BO\WorkBO;

class DeleteController extends Controller
{
    public function deleteWork(Request $request, Response $response) : Response
    {
        $workId = (int) $request->getQueryParam('id');
        $message = null;

        $workBo = new WorkBO($this->c->db);

        if ($workBo->hasWork($workId)) {
            $isSuccess = $workBo->delete($workId);

            if ($isSuccess) {
                $message = Constant::DELETE_SUCCESS;
            } else {
                $message = Constant::DELETE_FAIL;
            }
        } else {
            $message = Constant::DELETE_FAIL;
        }

        return $response->withJson(json_encode(['message' => $message]));
    }
}