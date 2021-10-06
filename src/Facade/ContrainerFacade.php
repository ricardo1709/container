<?php
declare(strict_types = 1);

namespace Ricardo1709\Container\Facade;

use Ricardo1709\Container\Container;
use Ricardo1709\Container\Contracts\ContainerContract;
use Ricardo1709\Container\Contracts\ContainerFactoryContract;

class ContainerFacade
{
	protected static ContainerContract $current = new Container;

	/**
	 * Swaps the facade.
	 *
	 * @param  ContainerContract $swap The new container.
	 * @return ContainerContract The old container.
	 */
	public static function swap(ContainerContract $swap): ContainerContract
	{
		$old = self::$current;
		self::$current = $swap;
		return $old;
	}

	/**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param  string $id Identifier of the entry to look for.
     *
     * @throws NotFoundException  No entry was found for **this** identifier.
     *
     * @return mixed Entry.
     */
    public static function get(string $id) // phpcs:ignore
    {
        return self::$current->get($id);
    }

    /**
     * Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     *
     * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
     * It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
     *
     * @param  string $id Identifier of the entry to look for.
     *
     * @return boolean
     */
    public function has(string $id): bool
    {
        return self::$current->has($id);
    }

    /**
     * Register an object for the contrainer.
     *
     * @param  string $id     Identifier of the entry.
     * @param  object $object The entry.
     * @return ContainerContract
     */
    public function set(string $id, $object): ContainerContract
    {
        return self::$current->set($id, $object);
    }

    /**
     * Register an object for the contrainer.
     *
     *
     * @param  string                   $id     Identifier of the entry.
     * @param  object|callable|\Closure $object The entry or callback to create the entry.
     * @return ContainerContract
     */
    public function register(string $id, $object): ContainerContract
    {
        return self::$current->register($id, $object);
    }

    /**
     * Register the factory for the service.
     *
     * @param  string                   $id      Identifier of the entry.
     * @param  ContainerFactoryContract $factory The factory for the entry.
     * @return ContainerContract
     */
    public function registerFactory(string $id, ContainerFactoryContract $factory): ContainerContract
    {
        return self::$current->registerFactory($id, $factory);
    }
}