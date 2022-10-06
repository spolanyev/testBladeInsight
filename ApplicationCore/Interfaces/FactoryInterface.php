<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

namespace TestBladeInsight;

interface FactoryInterface
{
    public function getModel(DataMapper $dataMapper): Model;
    public function getDataMapper(StorageAdapter $storageAdapter): DataMapper;
    public function getStorageAdapter(array $parameters): StorageAdapter;
    public function getResponse(): Response;
}
