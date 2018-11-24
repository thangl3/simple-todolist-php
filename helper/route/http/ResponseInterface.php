<?php
namespace Helper\Route\Http;

interface ResponseInterface
{
    public function write($output) : self;
}