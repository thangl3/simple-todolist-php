<?php
namespace App\Controller;

use Helper\Route\Http\RequestInterface as Request;
use Helper\Route\Http\ResponseInterface as Response;
use Helper\Route\Exception\NotFoundException;
use App\Utils\Constant;
use App\Model\BO\WorkBO;

class DeleteController extends Controller
{
    /**
     * Name of function must be mapping with call router
     * Controller when delete a work
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function deleteWork(Request $request, Response $response) : Response
    {
        $workId = (int) $request->getBodyParam('id');
        $message = null;

        $workBo = new WorkBO($this->c->db);

        if ($workBo->hasWork($workId)) {
            $isSuccess = $workBo->deleteWork($workId);

            if ($isSuccess) {
                $message = Constant::DELETE_SUCCESS;
            } else {
                $message = Constant::DELETE_FAIL;
            }
        } else {
            throw new NotFoundException($request, $response);
        }

        return $response->withJson(json_encode(['message' => $message]));
    }
}