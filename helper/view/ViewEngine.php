<?php
namespace Helper\View;

use RuntimeException;
use Helper\Route\Http\ResponseInterface;

class ViewEngine
{
    private $basePath = DIRECTORY_SEPARATOR;

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

        $extractOutputView = function () use($fileView, $data) {
            extract($data);

            // Compress content before print to client
            ob_start(function ($buffer) {
                // remove comments
                $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
                // remove tabs, spaces, newlines, etc.
                $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
                return $buffer;
            });

            include $fileView;

            return ob_get_clean();
        };

        $response->setOutput($extractOutputView);

        return $response;
    }
}