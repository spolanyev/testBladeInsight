<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

namespace TestBladeInsight;

interface ServerRequestInterface extends RequestInterface
{
    public function getHttpMethod(): HttpMethod;
    public function getPath(): string;
    public function normalize(): void;
    public function getParameters(): array | object;
    public function getId(): int | null;
    public function getEnvironment(): array | object;
    public function getParsedBody(): string | array | object;
}
