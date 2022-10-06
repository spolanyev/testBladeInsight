<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

namespace TestBladeInsight;

interface ServerResponseInterface extends ResponseInterface
{
    public function setHttpStatus(HttpStatus $httpStatus): void;
    public function setContent(string $content): void;
}
