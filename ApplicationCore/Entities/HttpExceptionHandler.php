<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

namespace TestBladeInsight;

final class HttpExceptionHandler implements ResponseInterface
{
    public function __construct(private readonly HttpStatus $httpStatus)
    {
    }

    public function respond(): never
    {
        http_response_code($this->httpStatus->value);
        exit();
    }
}
