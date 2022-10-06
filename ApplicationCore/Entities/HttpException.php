<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

namespace TestBladeInsight;

final class HttpException extends \RuntimeException implements HttpExceptionInterface
{
    private readonly HttpStatus $httpStatus;

    public function __construct(string $message = "", int $code = 0, \Throwable | null $previous = null)
    {
        $this->httpStatus = HttpStatus::from($code);
        parent::__construct($message, $code, $previous);
    }

    public function getHttpStatus(): HttpStatus
    {
        return $this->httpStatus;
    }
}
