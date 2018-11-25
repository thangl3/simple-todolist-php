<?php
namespace App\Controller;

use Helper\Route\Http\RequestInterface as Request;
use Helper\Route\Http\ResponseInterface as Response;
use App\Model\BO\WorkBO;
use App\Model\BO\StatusBO;

class HomeController extends Controller
{
    /**
     * Name of function must be mapping with call router
     * List all works from database to browser
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function listWork(Request $request, Response $response) : Response
    {
        $statusBo = new StatusBO();
        $workBo = new WorkBO($this->c->db);

        $status = $statusBo->getStatuses();
        $works = $workBo->getWorks();

        return $this->c->view->render(
            $response,
            'home.html.php',
            [
                'works'     => $works,
                'status'    => $status
            ]
        );
    }
}