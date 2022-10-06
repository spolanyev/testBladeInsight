<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

namespace TestBladeInsight;

final class Request implements ServerRequestInterface
{
    private array $parameters = [];

    public function __construct()
    {
        $fullPathFile = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'Startup' . DIRECTORY_SEPARATOR . '.env';
        if (!is_readable($fullPathFile)) {
            throw new \Exception('Unable to open .env file');
        }
        $file = null;
        $array = file($fullPathFile, FILE_IGNORE_NEW_LINES);
        foreach ($array as $line) {
            if (str_starts_with($line, 'DATABASE_FILE=')) {
                $file = trim(substr($line, strlen('DATABASE_FILE=')));
            }
        }

        if (empty($file)) {
            throw new \Exception('DATABASE_FILE not set');
        }

        $this->parameters['environment']['file'] = $file;
    }

    public function request(array $request): void
    {
        $this->validate($request);
        $this->parameters = $request;
    }

    public function getHttpMethod(): HttpMethod
    {
        return $this->parameters['method'];
    }

    public function getPath(): string
    {
        return $this->parameters['normalizedPath'];
    }

    public function normalize(): void
    {
        $this->parseHttp();
        $this->parseBody();
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function getId(): int | null
    {
        return $this->parameters['id'] ?? null;
    }

    public function getEnvironment(): array
    {
        return $this->parameters['environment'];
    }

    public function getParsedBody(): string
    {
        return $this->parameters['body'];
    }

    public function parseUri(string $uri): array
    {
        $pattern = '~^/(?<path>[a-z]+)/(?<number>\d+)/(?<value>[a-z]+).*~';
        if (preg_match($pattern, $uri)) {
            throw new HttpException('', HttpStatus::NotFound->value);//not supporting /address/1/entity
        }

        $pattern = '~^/(?<path>[a-z]+)/?(?<number>\d+)?(.*[?&]id=(?<id>\d+))?~';
        preg_match($pattern, $uri, $matches);
        if (empty($matches)) {
            throw new HttpException('', HttpStatus::NotFound->value);
        }
        $parameters['normalizedPath'] = '/' . $matches['path'];
        $number = $matches['id'] ?? $matches['number'] ?? null;//do not place Number before Id
        if (!is_null($number)) {
            $parameters['normalizedPath'] .= '/{id}';
            $parameters['id'] = $number;
        }
        return $parameters;
    }

    private function validate(array $parameters): void
    {
        if (!isset(
            $parameters['environment'],
            $parameters['environment']['file'],
            $parameters['method'],
            $parameters['normalizedPath'],
            $parameters['body'],
        )) {
            throw new \Exception('Invalid request object params');
        }
    }

    private function parseHttp(): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $result = HttpMethod::tryFrom($method);
        if (!$result) {
            throw new HttpException('', HttpStatus::MethodNotAllowed->value);
        }
        $this->parameters['method'] = $result;
        $uri = $_SERVER['REQUEST_URI'] ?? '';
        $this->parameters = [...$this->parameters, ...$this->parseUri($uri)];
    }

    private function parseBody(): void
    {
        $this->parameters['body'] = trim(file_get_contents("php://input"));
    }
}
