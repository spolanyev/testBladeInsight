<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

declare(strict_types=1);

namespace TestBladeInsight;

require dirname(__DIR__, 4) . DIRECTORY_SEPARATOR . 'UserInterface' . DIRECTORY_SEPARATOR
    . 'Startup' . DIRECTORY_SEPARATOR . 'autoload.php';

use PHPUnit\Framework\TestCase;

class HttpStatusTest extends TestCase
{
    public function testBasic(): void
    {
        $actual = [];
        foreach (HttpStatus::cases() as $object) {
            $actual[] = $object->value;
        }
        sort($actual);
        $expected = [200, 201, 204, 400, 404, 405, 500];
        sort($expected);
        $this->assertSame($expected, $actual);
    }
}
