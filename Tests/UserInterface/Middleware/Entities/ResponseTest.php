<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

declare(strict_types=1);

namespace TestBladeInsight;

require dirname(__DIR__, 4) . DIRECTORY_SEPARATOR . 'UserInterface' . DIRECTORY_SEPARATOR
    . 'Startup' . DIRECTORY_SEPARATOR . 'autoload.php';

use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    public function testBasic(): void
    {
        $response = new Response();
        $response->setHttpStatus(HttpStatus::BadRequest);
        $response->setContent('hello world');
        $this->expectNotToPerformAssertions();
    }
}
