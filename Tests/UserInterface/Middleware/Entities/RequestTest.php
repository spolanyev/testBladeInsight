<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

declare(strict_types=1);

namespace TestBladeInsight;

require dirname(__DIR__, 4) . DIRECTORY_SEPARATOR . 'UserInterface' . DIRECTORY_SEPARATOR
    . 'Startup' . DIRECTORY_SEPARATOR . 'autoload.php';

use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function testBasic(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/address?id=1';

        $array['environment']['file'] = 'turbines.csv';
        $array['method'] = HttpMethod::from('GET');
        $array['normalizedPath'] = '/address/{id}';
        $array['id'] = '1';
        $array['body'] = '';

        $manualRequest = new Request();
        $manualRequest->request($array);

        $autoRequest = new Request();
        $autoRequest->normalize();

        $this->assertSame($manualRequest->getParameters(), $autoRequest->getParameters());
    }

    public function testExceptionOne(): void
    {
        $manualRequest = new Request();
        $this->expectException(\Exception::class);
        $manualRequest->parseUri('');
    }

    public function testExceptionTwo(): void
    {
        $manualRequest = new Request();
        $this->expectException(\Exception::class);
        $manualRequest->parseUri('?id=10');
    }

    public function testExceptionThree(): void
    {
        $manualRequest = new Request();
        $this->expectException(\Exception::class);
        $manualRequest->parseUri('/address/10/value?id=20');
    }

    public function testExceptionFour(): void
    {
        $manualRequest = new Request();
        $this->expectException(\Exception::class);
        $manualRequest->parseUri('/address/10/value');
    }

    public function testParseUrlAddress(): void
    {
        $manualRequest = new Request();
        $this->assertSame(['normalizedPath' => '/address'], $manualRequest->parseUri('/address'));
    }

    public function testParseUrlList(): void
    {
        $manualRequest = new Request();
        foreach (
            [
                '/address/10',
                '/address/10/',
                '/address?id=10',
                '/address/?param=1&id=10',
            ] as $value
        ) {
            $this->assertSame(['normalizedPath' => '/address/{id}', 'id' => '10'], $manualRequest->parseUri($value));
        }
    }
}
