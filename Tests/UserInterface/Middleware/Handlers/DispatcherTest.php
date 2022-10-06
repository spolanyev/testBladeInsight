<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

declare(strict_types=1);

namespace TestBladeInsight;

require dirname(__DIR__, 4) . DIRECTORY_SEPARATOR . 'UserInterface' . DIRECTORY_SEPARATOR
    . 'Startup' . DIRECTORY_SEPARATOR . 'autoload.php';

use PHPUnit\Framework\TestCase;

class DispatcherTest extends TestCase
{
    public function testBasic(): void
    {
        $array['environment']['file'] = TEST_DATA_FILE;
        $array['method'] = HttpMethod::from('GET');
        $array['normalizedPath'] = '/address/{id}';
        $array['id'] = '1';
        $array['body'] = '';

        $manualRequest = new Request();
        $manualRequest->request($array);

        $controller = new Controller();

        $router = new Router();
        $router->addRule(HttpMethod::Get, '/address/{id}', [Controller::class, 'view']);

        $dispatcher = new Dispatcher($router, $controller);
        $response = $dispatcher->dispatch($manualRequest);

        $this->assertSame(true, $response instanceof ServerResponseInterface);
    }
}
