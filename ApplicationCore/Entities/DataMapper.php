<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

namespace TestBladeInsight;

/**
 * Here we get DOMAIN entities
 */
final class DataMapper implements ModelInterface
{
    public function __construct(private readonly StorageAdapter $adapter)
    {
    }

    public function create(string $parameters): int|false
    {
        return $this->adapter->create($parameters);
    }

    public function read(int|null $id): array
    {
        return $this->adapter->read($id) ?? throw new HttpException('', HttpStatus::NotFound->value);
    }

    public function update(int|null $id, string $parameters): int|false
    {
        return $this->adapter->update($id, $parameters) ?? throw new HttpException('', HttpStatus::NotFound->value);
    }

    public function delete(int|null $id): int|false
    {
        return $this->adapter->delete($id) ?? throw new HttpException('', HttpStatus::NotFound->value);
    }
}
