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
    private $bodyParams;
    private $queryParams;

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

        if (empty($_POST)) {
            $this->bodyParams = json_decode(file_get_contents("php://input"), true) ?? [];
        } else {
            $this->bodyParams = $_POST;
        }

        if (empty($_GET)) {
            $this->queryParams = explode('=', parse_url('http://abc.abc' .$this->requestUri, PHP_URL_QUERY)) ?? [];
        } else {
            $this->queryParams = $_GET;
        }
    }

    public function isPost() : bool
    {
        return $this->method === Method::POST;
    }

    public function isGet() : bool
    {
        return $this->method === Method::GET;
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

    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function setIsPostMethod()
    {
        $this->setMethod(Method::POST);
    }

    public function setIsGetMethod()
    {
        $this->setMethod(Method::GET);
    }

    /**
     * Return an array contain all value sent parsed vie method POST
     *
     * @return array
     */
    public function getBodyParams() : array
    {
        $params = [];

        foreach($this->bodyParams as $key => $value) {
            $params[$key] = filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        }

        return $params;
    }

    /**
     * Get a parameter from POST
     *
     * @param string $key
     * @return string
     */
    public function getBodyParam(string $key) : string
    {
        if (isset($this->bodyParams[$key])) {
            return filter_var($this->bodyParams[$key], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
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
        $params = [];

        foreach($this->queryParams as $key => $value) {
            $params[$key] = filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        }

        return $params;
    }

    /**
     * Get a parameter from GET
     *
     * @param string $key
     * @return string
     */
    public function getQueryParam(string $key) : string
    {
        if (isset($this->queryParams[$key])) {
            return filter_var($this->queryParams[$key], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
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

    public function withQueryParams(array $params)
    {
        $this->queryParams = $params;
    }

    public function withBodyParams(array $params)
    {
        $this->bodyParams = $params;
    }

    public function withQueryParam(string $key, string $value)
    {
        $this->queryParams[$key] = $value;
    }

    public function withBodyParam(string $key, string $value)
    {
        $this->bodyParams[$key] = $value;
    }
}