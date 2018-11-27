<?php
namespace App\Controller;

use Helper\Route\Http\RequestInterface as Request;
use Helper\Route\Http\ResponseInterface as Response;
use App\Model\BO\WorkBO;
use App\Model\BO\StatusBO;
use App\Utils\Constant;
use App\Utils\Util;

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
        return $this->c->view->render($response, 'home.html.php');
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

    public function fetchWorks(Request $request, Response $response) : Response
    {
        $workBo = new WorkBO($this->c->db);

        $works = $workBo->getWorks();

        return $this->transferDataToClient($response, $works);
    }

    public function fetchWorksHasWeekOfYear(Request $request, Response $response) : Response
    {
        $workBo = new WorkBO($this->c->db);

        $week = $request->getQueryParam('week');
        $year = $request->getQueryParam('year');
        
        if ($week > 0 && $week < 54) {
            $works = $workBo->getWorksHasWeekOfYear($week, $year);

            return $this->transferDataToClient($response, $works);
        }

        return $this->transferDataToClient($response, [], Constant::INVALID_DATE);
    }

    public function fetchWorksHasMonthOfYear(Request $request, Response $response) : Response
    {
        $workBo = new WorkBO($this->c->db);

        $month = $request->getQueryParam('month');
        $year = $request->getQueryParam('year');
        
        if ($month > 0 && $month < 13) {
            $works = $workBo->getWorksHasMonthOfYear($month, $year);

            return $this->transferDataToClient($response, $works);
        }

        return $this->transferDataToClient($response, [], Constant::INVALID_DATE);
    }

    public function fetchWorksToday(Request $request, Response $response) : Response
    {
        $workBo = new WorkBO($this->c->db);

        $date = $request->getQueryParam('date');
        
        if ($this->isValidDate($date)) {
            $works = $workBo->getWorksToday($date);

            return $this->transferDataToClient($response, $works);
        }

        return $this->transferDataToClient($response, [], Constant::INVALID_DATE);
    }

    private function transferDataToClient($response, $works, $message = '') : Response
    {
        $statusBo = new StatusBO();
        $status = $statusBo->getStatuses();

        $json = json_encode([
            'works' => $works,
            'status' => $status,
            'message' => $message
        ]);

        return $response->withJson($json);
    }

    private function isValidDate($date) : bool
    {
        return !Util::isWrongDateFormat($date);
    }
}