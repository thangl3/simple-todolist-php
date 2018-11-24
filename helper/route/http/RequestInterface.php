<?php
namespace Helper\Route\Http;

interface RequestInterface
{
    public function getMethod() : string;

    public function getBodyParams() : array;

    public function getQueryParams() : array;

    public function getParams() : array;

    public function getRequestTarget() : string;
}