<?php
namespace Helper\Route;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Container is a ArrayAccess with `key` and `value` (called is the entry of container)
 * `key` is string
 * `value` is the callable of Closure
 */
class Container implements \ArrayAccess, ContainerInterface
{
    /**
     * The container with the mission is working like DI
     *
     * @var array
     */
    private $container = [];

    /**
     * Frozen value of the entry in the container after user get it
     * Make sure callable in the container just run only one time
     *
     * @var array
     */
    private $frozen = [];

    public function __construct(array $userSettings = [])
    {
        $this->registerDefaultServices($userSettings);
    }

    /**
     * Register the default entries (services) to the container
     *
     * @param array $userSettings - Associative array of user settings, so they can it anywhere inthis route
     * @return void
     */
    private function registerDefaultServices(array $userSettings)
    {
        $defaultService = new DefaultServicesProvider($userSettings);
        $defaultService->register($this);
    }

    /**
     * This method was implemented when using \ArrayAccess
     * Add a new entry with key into the container
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function offsetSet($key, $value)
    {
        if (is_null($key)) {
            $this->container[] = $value;
        } else {
            $this->container[$key] = $value;
        }
    }

    /**
     * This method was implemented when using \ArrayAccess
     * Get the entry of the container by its key
     *
     * @param string $key
     * @return mixed
     */
    public function offsetGet($key)
    {
        if (isset($this->container[$key])) {
            if (is_callable($this->container[$key])) {
                // check already make have frozen the callable?
                if (!isset($this->frozen[$key])) {
                    $this->frozen[$key] = $this->container[$key]($this);
                }
                
                return $this->frozen[$key];
            }

            return $this->container[$key];
        }

        return null;
    }

    /**
     * This method was implemented when using \ArrayAccess
     * Returns true if the container can return an entry for the given key.
     * Returns false otherwise.
     *
     * @param string $key
     * @return mixed
     */
    public function offsetExists($key)
    {
        return isset($this->container[$key]);
    }

    /**
     * This method was implemented when using \ArrayAccess
     * Unset the antry with given the key
     *
     * @param string $key
     * @return void
     */
    public function offsetUnset($key)
    {
        unset($this->container[$key]);
    }

    /**
     * Get the entry of the container by its key
     *
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        return $this->offsetGet($key);
    }

    /**
     * Returns true if the container can return an entry for the given key.
     * Returns false otherwise.
     *
     * @param string $key
     * @return boolean
     */
    public function has(string $key)
    {
        return $this->offsetExists($key);
    }

    /**
     * A magic method help
     * Easy for access to default services have been declared or you have declared
     *
     * @param string $key
     * @return mixed
     */
    public function __get(string $key)
    {
        return $this->get($key);
    }
}
