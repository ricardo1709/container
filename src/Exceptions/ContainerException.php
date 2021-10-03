<?php
declare(strict_types = 1);

namespace Ricardo1709\Container\Exceptions;

use Psr\Container\ContainerExceptionInterface;
use RuntimeException;

class ContainerException extends RuntimeException implements ContainerExceptionInterface
{
}
