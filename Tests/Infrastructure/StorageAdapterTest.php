<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

declare(strict_types=1);

namespace TestBladeInsight;

require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'UserInterface' . DIRECTORY_SEPARATOR
    . 'Startup' . DIRECTORY_SEPARATOR . 'autoload.php';

use PHPUnit\Framework\TestCase;

class StorageAdapterTest extends TestCase
{
    public function testMutable(): void
    {
        $fullPathFile = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'ExternalDependencies'
            . DIRECTORY_SEPARATOR . 'Database' . DIRECTORY_SEPARATOR . TEST_DATA_FILE;
        $fullPathFileNew = $fullPathFile . '.tmp';

        copy($fullPathFile, $fullPathFileNew);

        $storageAdapter = new StorageAdapter([TEST_DATA_FILE . '.tmp']);

        //bulk update
        $string = 'Updated, Gamesa, 39.026628121, -9.048632539
            Amaral1-2, Gamesa, 39.026352641, -9.046270410
            Amaral1-3, Gamesa, 39.025990218, -9.044045397
            Amaral1-4, Gamesa, 39.025786934, -9.041793910
            Amaral1-5, Gamesa, 39.025322113, Updated';

        $storageAdapter->update(null, $string);
        $this->assertSame($this->getExpected($string), $storageAdapter->read(null));

        //update
        $string = 'Updated, Gamesa, 39.026628121, -9.048632539
            Amaral1-2, Gamesa, 39.026352641, -9.046270410
            Amaral1-3, Updated, 39.025990218, -9.044045397
            Amaral1-4, Gamesa, 39.025786934, -9.041793910
            Amaral1-5, Gamesa, 39.025322113, Updated';

        $storageAdapter->update(2, 'Amaral1-3, Updated, 39.025990218, -9.044045397');
        $storageAdapter->update(10, 'Amaral1-3, Updated, 39.025990218, -9.044045397');
        $this->assertSame($this->getExpected($string), $storageAdapter->read(null));

        //delete
        $string = 'Updated, Gamesa, 39.026628121, -9.048632539
            Amaral1-3, Updated, 39.025990218, -9.044045397
            Amaral1-5, Gamesa, 39.025322113, Updated';

        $storageAdapter->delete(1);
        $storageAdapter->delete(2);
        $storageAdapter->delete(10);
        $this->assertSame($this->getExpected($string), $storageAdapter->read(null));

        //bulk delete
        $storageAdapter->delete(null);
        $this->assertSame(null, $storageAdapter->read(null));

        //create
        $string = 'Created 1, Gamesa, 39.026628121, -9.048632539
            Created 2, Updated, 39.025990218, -9.044045397
            Created 3, Gamesa, 39.025322113, Updated';

        $storageAdapter->create('Created 1, Gamesa, 39.026628121, -9.048632539');
        $storageAdapter->create(
            'Created 2, Updated, 39.025990218, -9.044045397
            Created 3, Gamesa, 39.025322113, Updated'
        );
        $this->assertSame($this->getExpected($string), $storageAdapter->read(null));

        unlink($fullPathFileNew);

        //update without values
        $this->expectException(\Exception::class);
        $storageAdapter->update(0, '');
    }

    private function getExpected(string $string): array
    {
        return array_map(
            fn($line) => array_slice(array_filter(str_getcsv(trim($line))), 0, -1),
            explode("\n", $string)
        );
    }

    public function testExceptionOne()
    {
        $this->expectException(\Exception::class);
        $storageAdapter = new StorageAdapter(['notExistingFileName']);
    }

    public function testExceptionTwo()
    {
        $this->expectException(\Exception::class);
        $storageAdapter = new StorageAdapter(['notExistingFileName']);
    }
}
