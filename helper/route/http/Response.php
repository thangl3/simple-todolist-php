<?php
namespace Helper\Route\Http;

use Exception;

class Response implements ResponseInterface
{
    private $output;

    public function write($output) : ResponseInterface
    {
        try {
            ob_start();
            if (is_callable($output)) {
                echo $output();
            } else {
                echo $output;
            }
        } catch (Exception $ex) {
            // keep slient this exception because this is the last handle error
            // throw $ex;
        } finally {
            echo ob_get_clean();
            ob_end_flush();
        }

        return $this;
    }

    public function setOutput($output)
    {
        $this->output = $output;
    }

    public function getOutput()
    {
        return $this->output;
    }
}