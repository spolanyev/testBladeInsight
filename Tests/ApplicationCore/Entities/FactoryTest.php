<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

declare(strict_types=1);

namespace TestBladeInsight;

require dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'UserInterface' . DIRECTORY_SEPARATOR
    . 'Startup' . DIRECTORY_SEPARATOR . 'autoload.php';

use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    public function testBasic(): void
    {
        $factory = new Factory();
        $storageAdapter = $factory->getStorageAdapter([TEST_DATA_FILE]);
        $dataMapper = $factory->getDataMapper($storageAdapter);
        $model = $factory->getModel($dataMapper);
        $this->assertSame(true, $model instanceof ModelInterface);
    }
}
