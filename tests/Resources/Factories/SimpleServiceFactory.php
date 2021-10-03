<?php
declare(strict_types=1);

namespace Ricardo1709\Container\Tests\Resources\Factories;

use Ricardo1709\Container\Contracts\ContainerFactoryContract;
use Ricardo1709\Container\Tests\Resources\SimpleService;

class SimpleServiceFactory implements ContainerFactoryContract
{
	/**
	 * Create an new object on request.
	 *
	 * @return object
	 */
	public function create()
	{
		return new SimpleService;
	}
}