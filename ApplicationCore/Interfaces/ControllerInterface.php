<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

namespace TestBladeInsight;

interface ControllerInterface
{
    public function getResponse(ServerRequestInterface $request, array $handler): ServerResponseInterface;
}
