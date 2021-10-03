<?php
declare(strict_types = 1);

namespace Ricardo1709\Container\Contracts;

use Psr\Container\ContainerInterface;

interface ContainerContract extends ContainerInterface
{
    /**
     * Register an object for the contrainer.
     *
     * @param string $id     Identifier of the entry.
     * @param object $object The entry.
     * @return ContainerContract
     */
    public function set(string $id, $object): ContainerContract;

    /**
     * Register an object for the contrainer.
     *
     *
     * @param string                   $id     Identifier of the entry.
     * @param object|callable|\Closure $object The entry or callback to create the entry.
     * @return ContainerContract
     */
    public function register(string $id, $object): ContainerContract;

    /**
     * Register the factory for the service.
     *
     * @param string                   $id      Identifier of the entry.
     * @param ContainerFactoryContract $factory The factory for the entry.
     * @return ContainerContract
     */
    public function registerFactory(string $id, ContainerFactoryContract $factory): ContainerContract;
}
