<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

declare(strict_types=1);

namespace TestBladeInsight;

require dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'UserInterface' . DIRECTORY_SEPARATOR
    . 'Startup' . DIRECTORY_SEPARATOR . 'autoload.php';

use PHPUnit\Framework\TestCase;

class DataMapperTest extends TestCase
{
    public function testBasic(): void
    {
        $storageAdapter = new StorageAdapter([TEST_DATA_FILE]);
        $dataMapper = new DataMapper($storageAdapter);
        $result = $dataMapper->read(1);
        $this->assertSame([['Amaral1-2', ' Gamesa', ' 39.026352641']], $result);
    }

    public function testExceptionOne(): void
    {
        $storageAdapter = new StorageAdapter([TEST_DATA_FILE]);
        $dataMapper = new DataMapper($storageAdapter);
        $this->expectException(\Exception::class);
        $dataMapper->read(10);
    }
}
