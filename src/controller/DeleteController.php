<?php
namespace App\Controller;

use Helper\Route\Http\RequestInterface as Request;
use Helper\Route\Http\ResponseInterface as Response;
use App\Model\BO\WorkBO;

class DeleteController extends Controller
{
    public function deleteWork(Request $request, Response $response)
    {
        $workId = (int) $request->getQueryParam('id');

        $workBo = new WorkBO($this->c->db);

        if ($workBo->hasWork($workId)) {
            $isSuccess = $works = $workBo->delete($workId);

            if ($isSuccess) {
                $works = $workBo->selectAll();

                return $this->c->view->render(
                    $response,
                    'home.html.php',
                    [
                        'works' => $works,
                        'success' => 'Delete success'
                    ]
                );
            } else {
                $works = $workBo->selectAll();

                return $this->c->view->render(
                    $response,
                    'home.html.php',
                    [
                        'works' => $works,
                        'error' => 'Delete fail'
                    ]
                );
            }
        }

        throw new Exception('Not found');
    }
}