<?php
declare(strict_types=1);

namespace Ricardo1709\Container\Contracts;

use Psr\Container\ContainerInterface;

interface ContainerContract extends ContainerInterface
{
	/**
	 * Register an object for the contrainer.
	 *
	 * @param string $id
	 * @param object $object
	 * @return ContainerContract
	 */
	public function set(string $id, $object): ContainerContract;

	/**
	 * Register an object for the contrainer.
	 * 
	 *
	 * @param string $id
	 * @param object|callback|Closure $object
	 * @return ContainerContract
	 */
	public function register(string $id, $object): ContainerContract;

	/**
	 * Register the factory for the service.
	 *
	 * @param string $id
	 * @param ContainerFactoryContract $factory
	 * @return ContainerContract
	 */
	public function registerFactory(string $id, ContainerFactoryContract $factory): ContainerContract;
}