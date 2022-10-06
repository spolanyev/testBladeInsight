<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

namespace TestBladeInsight;

final class Application implements ApplicationInterface
{
    public function __construct(private readonly string $fullPathFileLog)
    {

    }

    public function run(): void
    {
        try {

            $request = new Request();
            $request->normalize();

            $router = new Router();
            $router->addRule(HttpMethod::Get, '/address/{id}', [Controller::class, 'view']);//old API entry point
            $router->addRule(HttpMethod::Get, '/addresses/{id}', [Controller::class, 'view']);
            $router->addRule(HttpMethod::Get, '/addresses', [Controller::class, 'view']);
            $router->addRule(HttpMethod::Post, '/addresses', [Controller::class, 'create']);
            $router->addRule(HttpMethod::Put, '/addresses/{id}', [Controller::class, 'update']);
            $router->addRule(HttpMethod::Put, '/addresses', [Controller::class, 'update']);
            $router->addRule(HttpMethod::Delete, '/addresses/{id}', [Controller::class, 'delete']);
            $router->addRule(HttpMethod::Delete, '/addresses', [Controller::class, 'delete']);

            $dispatcher = new Dispatcher($router, new Controller());

            $response = $dispatcher->dispatch($request);
            $response->respond();

        } catch (HttpException $exception) {
            (new HttpExceptionHandler($exception->getHttpStatus()))->respond();
        } catch (\Throwable $exception) {
            echo '<pre>', $exception, '</pre>';
            file_put_contents($this->fullPathFileLog, date('Y-m-d H:i:s ') . $exception . PHP_EOL, FILE_APPEND);
        }
    }
}
