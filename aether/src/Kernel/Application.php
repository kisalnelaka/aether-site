<?php

declare(strict_types=1);

namespace Aether\Kernel;

use Aether\Container\Container;
use Aether\Router\Router;
use Aether\Fiber\Scheduler;
use Aether\View\View;

final class Application
{
    private Container $container;
    private Router $router;
    private Scheduler $scheduler;
    private Kernel $kernel;
    private bool $booted = false;

    public function __construct(string $basePath = '')
    {
        $this->container = new Container();
        $this->router = new Router();
        $this->scheduler = new Scheduler();
        $this->kernel = new Kernel($this->container, $this->router, $this->scheduler);

        if ($basePath !== '') {
            $this->container->instance('path.base', $basePath);
        }
    }

    public static function create(string $basePath = ''): self
    {
        return new self($basePath);
    }

    public function get(string $path, string $handler, string $name = ''): self
    {
        $this->router->get($path, $handler, $name);
        return $this;
    }

    public function run(): void
    {
        $this->kernel->boot();
        $this->booted = true;

        $request = \Aether\Http\Request::fromGlobals();
        $response = $this->kernel->handle($request);
        $response->send();
    }
}
