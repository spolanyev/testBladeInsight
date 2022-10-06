<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

declare(strict_types=1);

namespace TestBladeInsight;

require dirname(__DIR__, 4) . DIRECTORY_SEPARATOR . 'UserInterface' . DIRECTORY_SEPARATOR
    . 'Startup' . DIRECTORY_SEPARATOR . 'autoload.php';

use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    public function testBasic(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/address?id=1';

        $request = new Request();
        $request->normalize();
        $router = new Router();
        $router->addRule(HttpMethod::Get, '/address/{id}', [\stdClass::class, 'view']);
        $this->assertSame([\stdClass::class, 'view'], $router->getHandler($request));
    }
}
