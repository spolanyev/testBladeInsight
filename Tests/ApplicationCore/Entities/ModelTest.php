<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

declare(strict_types=1);

namespace TestBladeInsight;

require dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'UserInterface' . DIRECTORY_SEPARATOR
    . 'Startup' . DIRECTORY_SEPARATOR . 'autoload.php';

use PHPUnit\Framework\TestCase;

class ModelTest extends TestCase
{
    public function testBasic(): void
    {
        $dataMapper = new DataMapper(new StorageAdapter([TEST_DATA_FILE]));
        $model = new Model($dataMapper);
        $result = $model->read(1);
        $this->assertSame(['Amaral1-2', ' Gamesa', ' 39.026352641'], $result);
    }
}
