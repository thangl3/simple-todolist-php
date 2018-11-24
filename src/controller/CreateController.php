<?php
namespace App\Controller;

use Helper\Route\Http\RequestInterface as Request;
use Helper\Route\Http\ResponseInterface as Response;
use App\Model\BO\WorkBO;

class CreateController extends Controller
{
    public function createWork(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $workBo = new WorkBO($this->c->db);
            $latestId = $works = $workBo->create([
                'workName' => $request->getBodyParam('workName'),
                'startDate' => $request->getBodyParam('startDate'),
                'endDate' => $request->getBodyParam('endDate')
            ]);
        }

        return $this->c->view->render(
            $response,
            'create.html.php',
            [
                
            ]
        );
    }
}