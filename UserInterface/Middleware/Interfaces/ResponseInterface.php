<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

namespace TestBladeInsight;

interface ResponseInterface
{
    public function respond(): string | int | float | bool | null | array | object;
}
