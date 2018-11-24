<?php
namespace App\Controller;

use Helper\Route\Http\RequestInterface as Request;
use Helper\Route\Http\ResponseInterface as Response;
use App\Model\BO\WorkBO;

class UpdateController extends Controller
{
    public function updateWork(Request $request, Response $response)
    {
        $workId = $request->getParam('id');
        $workBo = new WorkBO($this->c->db);
        
        if ($request->isPost() && $workBo->hasWork($workId)) {
            $isSuccess = $workBo->update([
                'workId' => $workId,
                'workName' => $request->getBodyParam('workName'),
                'startDate' => $request->getBodyParam('startDate'),
                'endDate' => $request->getBodyParam('endDate'),
                'status' => $request->getBodyParam('status')
            ]);
    
            if ($isSuccess) {

            } else {
    
            }
        } elseif ($request->isget()) {
            $workId = $request->getQueryParam('id');

            $work = $workBo->select($workId);

            return $this->c->view->render(
                $response,
                'update.html.php',
                [
                    'work' => $work
                ]
            );
        }

        throw new Exception('Not found');
    }

    public function updateStatus(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $workBo = new WorkBO($this->c->db);
            $isSuccess = $works = $workBo->updateStatus([
                'workId' => $request->getBodyParam('workId'),
                'status' => $request->getBodyParam('status')
            ]);

            if ($isSuccess) {

            } else {

            }
        }
    }
}