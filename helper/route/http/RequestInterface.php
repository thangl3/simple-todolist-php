<?php
namespace Helper\Route\Http;

interface RequestInterface
{
    public function isPost();

    public function isGet();

    public function getBodyParams();

    public function getQueryParams();

    public function getParams();

    public function getRequestTarget();
}