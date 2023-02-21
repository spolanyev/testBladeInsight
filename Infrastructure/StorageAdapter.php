<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

namespace TestBladeInsight;

final class StorageAdapter implements ModelInterface
{
    private string $fullPathFile = '';

    public function __construct(array $parameters)
    {
        $file = $parameters[0];
        $fullPathFile = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'ExternalDependencies'
            . DIRECTORY_SEPARATOR . 'Database' . DIRECTORY_SEPARATOR . $file;

        if (!file_exists($fullPathFile)) {
            throw new \Exception('Storage not found');
        }

        $this->fullPathFile = $fullPathFile;
    }

    public function create(string $parameters): int|false
    {
        $records = $this->parseInput($parameters);
        return file_put_contents($this->fullPathFile, implode(PHP_EOL, $records) . PHP_EOL, FILE_APPEND);
    }

    public function read(int|null $id): array|null
    {
        $records = $this->getRecords($id);
        if (empty($records)) {
            return null;
        }
        //remove last field in record
        return array_map(fn($array) => array_slice($array, 0, -1), $records);
    }

    public function update(int|null $id, string $parameters): int|false|null
    {
        $newRecords = $this->parseInput(string: $parameters, isPlain: true);

        if (empty($newRecords)) {
            throw new HttpException('', HttpStatus::BadRequest->value);
        }

        $resultingRecords = [];
        $isFound = false;
        $existingRecords = $this->getRecords(isPlain: true);
        if (is_null($id)) {//bulk update case
            if (count($existingRecords) != count($newRecords)) {
                throw new HttpException('', HttpStatus::BadRequest->value);
            }
            $resultingRecords = &$newRecords;
            unset($newRecords);
            $isFound = true;
        } else {
            if (isset($existingRecords[$id])) {//update one
                if (count($newRecords) > 1) {
                    throw new HttpException('', HttpStatus::BadRequest->value);
                }
                $resultingRecords = &$existingRecords;
                unset($existingRecords);
                $resultingRecords[$id] = $newRecords[0];
                $isFound = true;
            }
        }

        if ($isFound) {
            return file_put_contents($this->fullPathFile, implode(PHP_EOL, $resultingRecords) . PHP_EOL);
        }
        return null;
    }

    public function delete(int|null $id): int|false|null
    {
        if (is_null($id)) {
            return file_put_contents($this->fullPathFile, '');
        }

        $records = $this->getRecords(isPlain: true);
        if (isset($records[$id])) {
            unset($records[$id]);
            return file_put_contents($this->fullPathFile, implode(PHP_EOL, $records) . PHP_EOL);
        }
        return null;
    }

    private function getRecords(int|null $id = null, bool $isPlain = false): array
    {
        $result = [];
        $count = 0;
        $isAllRequired = false;
        if (is_null($id)) {
            $isAllRequired = true;
        }

        if ($filePointer = fopen($this->fullPathFile, 'rb')) {
            while (false !== ($record = fgetcsv($filePointer))) {
                if ($count == $id || $isAllRequired) {
                    if (!$isPlain) {
                        $result[] = $record;
                    } else {
                        $result[] = implode(',', $record);
                    }
                    if (!$isAllRequired) {
                        break;
                    }
                }
                $count++;
            }
            fclose($filePointer);
        }
        return $result;
    }

    private function parseInput(string $string, bool $isPlain = true): array
    {
        $input = explode("\n", $string);
        $records = [];
        foreach ($input as $line) {
            //Amaral1-1, Gamesa, 39.026628121, -9.048632539
            $line = trim($line);
            if ('' == $line) {
                continue;
            }
            $record = array_filter(str_getcsv($line));
            if (count($record) != 4) {
                throw new HttpException('', HttpStatus::BadRequest->value);
            }
            if ($isPlain) {
                $records[] = implode(',', $record);
            } else {
                $records[] = $record;
            }
        }
        return $records;
    }
}
