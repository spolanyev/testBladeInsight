<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

namespace TestBladeInsight;

final class Router implements RouterInterface
{
    private array $handler = [];

    public function addRule(HttpMethod $method, string $path, array $handler): void
    {
        $this->handler[$method->value][$path] = $handler;
    }

    public function getHandler(ServerRequestInterface $request): array | false
    {
        $method = $request->getHttpMethod()->value;
        $path = $request->getPath();
        return $this->handler[$method][$path] ?? false;
    }
}
