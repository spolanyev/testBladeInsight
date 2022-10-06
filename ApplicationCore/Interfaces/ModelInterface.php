<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

namespace TestBladeInsight;

interface ModelInterface
{
    public function create(string $parameters)
        : bool | int | string | array | object;

    public function read(int $id)
        : string | null | false | array | object;

    public function update(int $id, string $parameters)
        : bool | null | int | string | array | object;

    public function delete(int $id)
        : bool | null | int | string | array | object;
}
