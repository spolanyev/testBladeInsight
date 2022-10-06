<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

declare(strict_types=1);

namespace TestBladeInsight;

require dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'UserInterface' . DIRECTORY_SEPARATOR
    . 'Startup' . DIRECTORY_SEPARATOR . 'autoload.php';

use PHPUnit\Framework\TestCase;

class HttpExceptionTest extends TestCase
{
    public function testBasic(): void
    {
        $this->expectException(HttpException::class);
        throw new HttpException('', HttpStatus::MethodNotAllowed->value);
    }
}
