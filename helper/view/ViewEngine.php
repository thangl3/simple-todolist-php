<?php
namespace Helper\View;

use RuntimeException;
use Helper\Route\Http\ResponseInterface;

class ViewEngine
{
    private $basePath;

    public function __construct(string $basePath)
    {
        $this->basePath = $basePath;
    }

    public function setBasePath(string $path) : void
    {
        $this->basePath = $path;
    }

    public function getBasePath() : string
    {
        return $this->basePath;
    }

    public function render(ResponseInterface $response, string $viewTemplate, array $data = []) : ResponseInterface
    {
        $fileView = $this->basePath .DIRECTORY_SEPARATOR .$viewTemplate;
    
        if (!file_exists($fileView)) {
            throw new RuntimeException(sprintf('Wrong path to the template. Your path is: %s', $fileView));
        }

        $extractOutputView = function () use ($fileView, $data) {
            extract($data);

            ob_start('ob_gzhandler');

            include $fileView;

            return ob_get_clean();
        };

        $response->setBody($extractOutputView);

        return $response;
    }
}