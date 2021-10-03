<?php
declare(strict_types = 1);

namespace Ricardo1709\Container\Exceptions;

use Psr\Container\NotFoundExceptionInterface;

class NotFoundException extends ContainerException implements NotFoundExceptionInterface
{
}
