<?php
namespace Helper\Route\Http;

class Request implements RequestInterface
{
    private $environment;
    private $body;
    private $headers;
    private $extractUri;
    private $requestUri;
    private $method;

    public function __construct(Environment $environment)
    {
        $this->environment = $environment;
        $this->parseEnvironment();
    }

    private function parseEnvironment()
    {
        $this->method = $this->environment->get('REQUEST_METHOD');
        $this->requestUri = $this->environment->get('REQUEST_URI');
        $this->extractUri = parse_url('http://abc.abc' .$this->requestUri, PHP_URL_PATH);
    }

    public function isPost() : bool
    {
        return $this->method === Method::$POST;
    }

    public function isGet() : bool
    {
        return $this->method === Method::$GET;
    }

    /**
     * Get current method in request
     *
     * @return string
     */
    public function getMethod() : string
    {
        return $this->method;
    }

    /**
     * Return an array contain all value sent parsed vie method POST
     *
     * @return array
     */
    public function getBodyParams() : array
    {
        if ($this->isPost()) {
            $params = [];

            foreach($_POST as $key => $value) {
                $params[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }

            return $params;
        }

        return [];
    }

    /**
     * Get a parameter from POST
     *
     * @param string $key
     * @return string
     */
    public function getBodyParam(string $key) : string
    {
        if ($this->isPost()) {
            if (isset($_POST[$key])) {
                return filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return '';
    }

    /**
     * Return an array with value parsed query parameter in url
     *
     * @return array
     */
    public function getQueryParams() : array
    {
        if ($this->isGet()) {
            $params = [];

            foreach($_GET as $key => $value) {
                $params[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }

            return $params;
        }

        return [];
    }

    /**
     * Get a parameter from GET
     *
     * @param string $key
     * @return string
     */
    public function getQueryParam(string $key) : string
    {
        if ($this->isGet()) {
            if (isset($_GET[$key])) {
                return filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return '';
    }

    /**
     * Return an array contain all paramater via GET and POST method
     *
     * @return array
     */
    public function getParams() : array
    {
        return array_merge($this->getBodyParams(), $this->getQueryParams());
    }

    /**
     * Get a parameter in GET and POST method http request
     *
     * @param string $key
     * @return string
     */
    public function getParam(string $key) : string
    {
        $params = $this->getParams();

        if (isset($params[$key])) {
            return $params[$key];
        }

        return '';
    }

    /**
     * Return only request target not include query or scheme
     *
     * @return string
     */
    public function getRequestTarget() : string
    {
        if ($this->extractUri) {
            return $this->extractUri;
        } else {
            return '/';
        }
    }
}