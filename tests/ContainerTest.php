<?php
declare(strict_types=1);

namespace Ricardo1709\Container\Tests;

use PHPUnit\Framework\TestCase;
use Ricardo1709\Container\Container;
use Ricardo1709\Container\Contracts\ContainerContract;
use Ricardo1709\Container\Exceptions\NotFoundException;
use Ricardo1709\Container\Tests\Resources\Contracts\SimpleServiceContract;
use Ricardo1709\Container\Tests\Resources\Factories\SimpleServiceFactory;
use Ricardo1709\Container\Tests\Resources\SimpleService;

final class ContainerTest extends TestCase
{
    public function testHasOfUndefinedService(): ContainerContract
    {
        $container = new Container;

        $this->assertFalse($container->has(SimpleServiceContract::class));

        return $container;
    }

    /**
     * @depends testHasOfUndefinedService
     */
    public function testGetOfUndefinedService(ContainerContract $container): void
    {
        $this->expectException(NotFoundException::class);
        
        $container->get(SimpleServiceContract::class);
    }

    /**
     * @depends testHasOfUndefinedService
     */
    public function testSetService(ContainerContract $container): ContainerContract
    {
        $this->assertSame($container, $container->set(SimpleServiceContract::class, new SimpleService));

        return $container;
    }

    /**
     * @depends testSetService
     */
    public function testHasOfSetService(ContainerContract $container): ContainerContract
    {
        $this->assertTrue($container->has(SimpleServiceContract::class));

        return $container;
    }

    /**
     * @depends testHasOfSetService
     */
    public function testGetOfSetService(ContainerContract $container): void
    {
        $service = $container->get(SimpleServiceContract::class);

        $this->assertInstanceOf(SimpleServiceContract::class, $service);

        $this->assertSame($service, $container->get(SimpleServiceContract::class));
    }

    /**
     * @depends testHasOfUndefinedService
     */
    public function testRegisteredService(ContainerContract $container): ContainerContract
    {
        $this->assertSame($container, $container->register(SimpleServiceContract::class, new SimpleService));

        return $container;
    }

    /**
     * @depends testRegisteredService
     */
    public function testHasOfRegisteredService(ContainerContract $container): ContainerContract
    {
        $this->assertTrue($container->has(SimpleServiceContract::class));

        return $container;
    }

    /**
     * @depends testHasOfRegisteredService
     */
    public function testGetOfRegisteredService(ContainerContract $container): void
    {
        $service = $container->get(SimpleServiceContract::class);

        $this->assertInstanceOf(SimpleServiceContract::class, $service);

        $this->assertSame($service, $container->get(SimpleServiceContract::class));
    }

    /**
     * @depends testHasOfUndefinedService
     */
    public function testRegisteredFactory(ContainerContract $container): ContainerContract
    {
        $this->assertSame($container, $container->registerFactory(
            SimpleServiceContract::class,
            new SimpleServiceFactory
        ));

        return $container;
    }

    /**
     * @depends testRegisteredFactory
     */
    public function testHasOfRegisteredFactory(ContainerContract $container): ContainerContract
    {
        $this->assertTrue($container->has(SimpleServiceContract::class));

        return $container;
    }

    /**
     * @depends testHasOfRegisteredFactory
     */
    public function testGetOfRegisteredFactory(ContainerContract $container): void
    {
        $service = $container->get(SimpleServiceContract::class);

        $this->assertInstanceOf(SimpleServiceContract::class, $service);

        $service2 = $container->get(SimpleServiceContract::class);

        $this->assertNotSame($service, $service2);
        $this->assertEquals($service, $service2);
    }

    /**
     * @depends testHasOfUndefinedService
     */
    public function testRegisteredCallback(ContainerContract $container): ContainerContract
    {
        $this->assertSame($container, $container->register(SimpleServiceContract::class, function () {
            return new SimpleService;
        }));

        return $container;
    }

    /**
     * @depends testRegisteredCallback
     */
    public function testHasOfRegisteredCallback(ContainerContract $container): ContainerContract
    {
        $this->assertTrue($container->has(SimpleServiceContract::class));

        return $container;
    }

    /**
     * @depends testHasOfRegisteredCallback
     */
    public function testGetOfRegisteredCallback(ContainerContract $container): void
    {
        $service = $container->get(SimpleServiceContract::class);

        $this->assertInstanceOf(SimpleServiceContract::class, $service);

        $service2 = $container->get(SimpleServiceContract::class);

        $this->assertNotSame($service, $service2);
        $this->assertEquals($service, $service2);
    }
}