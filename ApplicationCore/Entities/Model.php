<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

namespace TestBladeInsight;

final class Model implements ModelInterface
{
    public function __construct(private readonly DataMapper $dataMapper)
    {

    }

    public function create(string $parameters): int | false
    {
        return $this->dataMapper->create($parameters);
    }

    public function read(int | null $id): array
    {
        $records = $this->dataMapper->read($id);
        if (1 == count($records)) {
            $records = $records[0];
        }
        return $records;
    }

    public function update(int | null $id, string $parameters): int | false
    {
        return $this->dataMapper->update($id, $parameters);
    }

    public function delete(int | null $id): int | false
    {
        return $this->dataMapper->delete($id);
    }
}
