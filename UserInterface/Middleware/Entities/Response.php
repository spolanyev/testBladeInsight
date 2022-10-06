<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

namespace TestBladeInsight;

final class Response implements ServerResponseInterface
{
    protected httpStatus $httpStatus = HttpStatus::OK;
    protected mixed $content = '';

    public function respond(): never
    {
        http_response_code($this->httpStatus->value);
        if (!empty($this->content)) {
            header('Content-Type: application/json');
            echo json_encode($this->content, JSON_THROW_ON_ERROR);
        }
        exit();
    }

    public function setHttpStatus(HttpStatus $httpStatus): void
    {
        $this->httpStatus = $httpStatus;
    }

    public function setContent($content): void
    {
        $this->content = $content;
    }
}
