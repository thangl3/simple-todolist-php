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
    public function index(Request $request, Response $response) : Response
    {
        return $this->c->view->render(
            $response,
            'home.html.php'
        );
    }

    public function fetchWorks(Request $request, Response $response) : Response
    {
        $statusBo = new StatusBO();
        $workBo = new WorkBO($this->c->db);

        $status = $statusBo->getStatuses();
        $works = $workBo->getWorks();

        $json = json_encode([
            'works' => $works,
            'status' => $status
        ]);

        return $response->withJson($json);
    }

    public function fetchWork(Request $request, Response $response) : Response
    {
        $workId = (int) $request->getBodyParam('workId');

        $statusBo = new StatusBO();
        $workBo = new WorkBO($this->c->db);

        $status = $statusBo->getStatuses();
        $work = $workBo->getWork($workId);

        $json = json_encode([
            'work' => $work,
            'status' => $status
        ]);

        return $response->withJson($json);
    }
}