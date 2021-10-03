<?php
declare(strict_types=1);

namespace Ricardo1709\Container\Contracts;

interface ContainerFactoryContract
{
	/**
	 * Create an new object on request.
	 *
	 * @return object
	 */
	public function create();
}