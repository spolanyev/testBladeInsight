<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

namespace TestBladeInsight;

interface RouterInterface
{
    public function addRule(HttpMethod $method, string $path, array $handler): void;
    public function getHandler(ServerRequestInterface $request): string | false | array | callable;
}
