<?php
namespace App\Controller;

use Helper\Route\Http\RequestInterface as Request;
use Helper\Route\Http\ResponseInterface as Response;
use App\Model\BO\WorkBO;

class HomeController extends Controller
{
    public function listWork(Request $request, Response $response) : Response
    {
        $workBo = new WorkBO($this->c->db);
        $works = $workBo->selectAll();

        return $this->c->view->render(
            $response,
            'home.html.php',
            [
                'works' => $works
            ]
        );
    }
}