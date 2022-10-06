<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

declare(strict_types=1);

namespace TestBladeInsight;

require dirname(__DIR__, 4) . DIRECTORY_SEPARATOR . 'UserInterface' . DIRECTORY_SEPARATOR
    . 'Startup' . DIRECTORY_SEPARATOR . 'autoload.php';

use PHPUnit\Framework\TestCase;

class HttpMethodTest extends TestCase
{
    public function testBasic(): void
    {
        $actual = [];
        foreach (HttpMethod::cases() as $object) {
            $actual[] = $object->value;
        }
        sort($actual);
        $expected = ['POST', 'GET', 'PUT', 'DELETE'];
        sort($expected);
        $this->assertSame($expected, $actual);
    }
}
