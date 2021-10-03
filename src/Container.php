<?php
declare(strict_types = 1);

namespace Ricardo1709\Container;

use Closure;
use Ricardo1709\Container\Contracts\ContainerContract;
use Ricardo1709\Container\Contracts\ContainerFactoryContract;
use Ricardo1709\Container\Exceptions\NotFoundException;
use Ricardo1709\Container\Factories\ClosureFactory;

class Container implements ContainerContract
{
    /**
     * All the registered services.
     *
     * @var array<string, object>
     */
    protected $services = [];

    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @throws NotFoundException  No entry was found for **this** identifier.
     *
     * @return mixed Entry.
     */
    public function get(string $id) // phpcs:ignore
    {
        if (!$this->has($id)) {
            throw new NotFoundException("The service \"$id\" not found.");
        }

        $item = $this->services[$id];

        if ($item instanceof ContainerFactoryContract) {
            return $item->create();
        }

        return $item;
    }

    /**
     * Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     *
     * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
     * It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @return boolean
     */
    public function has(string $id): bool
    {
        return array_key_exists($id, $this->services);
    }

    /**
     * Register an object for the contrainer.
     *
     * @param string $id     Identifier of the entry.
     * @param object $object The entry.
     * @return ContainerContract
     */
    public function set(string $id, $object): ContainerContract
    {
        $this->services[$id] = $object;

        return $this;
    }

    /**
     * Register an object for the contrainer.
     *
     *
     * @param string                   $id     Identifier of the entry.
     * @param object|callable|\Closure $object The entry or callback to create the entry.
     * @return ContainerContract
     */
    public function register(string $id, $object): ContainerContract
    {
        if (is_callable($object) || $object instanceof Closure) {
            return $this->registerFactory($id, new ClosureFactory($object));
        }

        return $this->set($id, $object);
    }

    /**
     * Register the factory for the service.
     *
     * @param string                   $id      Identifier of the entry.
     * @param ContainerFactoryContract $factory The factory for the entry.
     * @return ContainerContract
     */
    public function registerFactory(string $id, ContainerFactoryContract $factory): ContainerContract
    {
        return $this->set($id, $factory);
    }
}
