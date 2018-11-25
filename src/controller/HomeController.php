<?php
namespace App\Controller;

use Helper\Route\Http\RequestInterface as Request;
use Helper\Route\Http\ResponseInterface as Response;
use App\Model\BO\WorkBO;
use App\Model\BO\StatusBO;

class HomeController extends Controller
{
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