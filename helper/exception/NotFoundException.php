<?php
namespace Helper\Route\Exception;

use Helper\Route\Http\RequestInterface;
use Helper\Route\Http\ResponseInterface;

class NotFoundException extends \Exception
{
    protected $request;
    protected $response;

    public function __construct(RequestInterface $request = null, ResponseInterface $response = null)
    {
        parent::__construct();
        $this->request = $request;
        $this->response = $response;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getResponse()
    {
        return $this->response;
    }
}