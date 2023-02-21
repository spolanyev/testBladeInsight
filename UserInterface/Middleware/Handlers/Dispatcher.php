<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

namespace TestBladeInsight;

final class Dispatcher implements DispatcherInterface
{
    public function __construct(
        private readonly RouterInterface $router,
        private readonly ControllerInterface $controller
    ) {
    }

    public function dispatch(ServerRequestInterface $request): ServerResponseInterface
    {
        $handler = $this->router->getHandler($request);
        if (!$handler) {
            throw new HttpException('', HttpStatus::NotFound->value);
        }
        return $this->controller->getResponse($request, $handler);
    }
}
