<?php
declare(strict_types = 1);

namespace Ricardo1709\Container\Factories;

use Ricardo1709\Container\Contracts\ContainerFactoryContract;

class ClosureFactory implements ContainerFactoryContract
{
    /**
     * The closure or callback.
     *
     * @var callable|\Closure
     */
    protected $closure;

    /**
     * Constructor
     *
     * @param callable|\Closure $closure The callback.
     */
    public function __construct($closure)
    {
        $this->closure = $closure;
    }

    /**
     * Create an new object on request.
     *
     * @return object
     */
    public function create(): object
    {
        $closure = $this->closure;
        
        return $closure();
    }
}
