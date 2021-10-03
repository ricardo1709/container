<?php
declare(strict_types=1);

namespace Ricardo1709\Container\Tests\Resources;

use Ricardo1709\Container\Tests\Resources\Contracts\SimpleServiceContract;

class SimpleService implements SimpleServiceContract
{
	/**
	 * This is a simple test case of a service.
	 *
	 * @return string
	 */
	public function hello(): string
	{
		return 'world';
	}
}