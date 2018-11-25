<?php
namespace Helper\Route\Http;

interface ResponseInterface
{
    public function write($body) : self;
    public function getBody();
    public function setBody($body);
}