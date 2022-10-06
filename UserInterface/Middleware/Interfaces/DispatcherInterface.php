<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

namespace TestBladeInsight;

interface DispatcherInterface
{
    public function dispatch(ServerRequestInterface $request): ServerResponseInterface;
}
