<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

namespace TestBladeInsight;

interface HttpExceptionInterface extends \Throwable
{
    public function getHttpStatus(): HttpStatus;
}
