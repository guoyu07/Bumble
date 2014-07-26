<?php

namespace League\Bumble\Util;

abstract class FunctionLibWrapper
{

    /**
     * A common prefix at the beginning of all function calls.
     * @var string
     */
    protected $prefix = '';

    /**
     * The namespace in which functions are declared. Must not have trailing namespace separator.
     * @var string
     */
    protected $namespace = '';

    /**
     * Magic method to wrap function calls
     *
     * @param string $method
     * @param array $args
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
    }

    /**
     * Make sure the method is in the array of allowed names
     *
     * Prefix is prepended to the method name.
     *
     * @param string $method
     * @throws \Exception if the method name is invalid
     * @throws \Exception if the function does not exist
     *
     * @return string The correctly formatted function to be executed
     */
    protected function validateMethodName($method)
    {
    }

    /**
     * @return array An array of allowed function names
     */
    abstract protected function getAllowedMethods();
}
