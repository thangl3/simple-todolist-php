<?php
namespace Helper\Route\Http;

use Exception;

class Response implements ResponseInterface
{
    private $body;

    public function write($body) : ResponseInterface
    {
        ob_start();

        if (is_callable($body)) {
            $this->body = $body();
            echo $body();
        } elseif ($body !== null) {
            $this->body = $body;
            echo $body;
        } else {
            echo $this->getBody();
        }

        echo ob_get_clean();

        return clone $this;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function getBody()
    {
        return $this->body;
    }

    /**
     * Redirect path to new address
     *
     * @param string $pathTo
     * @param integer $statusCode
     * @return void
     */
    public function redirectTo(string $pathTo, int $statusCode = 301)
    {
        header('Location: ' .$pathTo, true, $statusCode);

        return $this;
    }

    /**
     * Set output to client is json
     *
     * @param string $json
     * @return void
     */
    public function withJson(string $json)
    {
        header('Content-Type: application/json');
        $this->setBody($json);

        return $this;
    }

    /**
     * Set status code to header response
     *
     * @param int $statusCode
     * @return void
     */
    public function withStatus($statusCode)
    {
        http_response_code($statusCode);

        return $this;
    }
}