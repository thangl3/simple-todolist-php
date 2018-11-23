<?php

namespace App\Controller;

use Helper\Route\ContainerInterface;

abstract class Controller
{
    /**
     * The container instance.
     *
     * @var Helper\Route\ContainerInterface
     */
    protected $c;

    /**
     * Set up controllers to have access to the container.
     *
     * @param Helper\Route\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->c = $container;
    }
}
