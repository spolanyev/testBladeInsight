<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

namespace TestBladeInsight;

final class Factory implements FactoryInterface
{
    public function getModel(DataMapper $dataMapper): Model
    {
        return new Model($dataMapper);
    }

    public function getDataMapper(StorageAdapter $storageAdapter): DataMapper
    {
        return new DataMapper($storageAdapter);
    }

    public function getStorageAdapter(array $parameters): StorageAdapter
    {
        return new StorageAdapter($parameters);
    }

    public function getResponse(): Response
    {
        return new Response();
    }
}
