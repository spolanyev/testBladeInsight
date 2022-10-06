<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

namespace TestBladeInsight;

final class Controller implements ControllerInterface
{
    public function __construct(private readonly Factory $factory = new Factory()) {

    }

    public function getResponse(ServerRequestInterface $request, array $handler): ServerResponseInterface
    {
        [$className, $methodName] = $handler;
        if (__CLASS__ != $className) {
            throw new \Exception('Currently only Controller::method allowed');
        }
        return $this->$methodName($request);
    }

    private function view(ServerRequestInterface $request): ServerResponseInterface
    {
        [ , , $model] = $this->setUp($request);
        $result = $model->read($request->getId());
        $response = $this->factory->getResponse();
        $response->setContent($result);
        return $response;
    }

    private function create(ServerRequestInterface $request): ServerResponseInterface
    {
        [ , , $model] = $this->setUp($request);
        $result = $model->create($request->getParsedBody());
        return $this->setDown($result, HttpStatus::Created);
    }

    private function update(ServerRequestInterface $request): ServerResponseInterface
    {
        [ , , $model] = $this->setUp($request);
        $result = $model->update($request->getId(), $request->getParsedBody());
        return $this->setDown($result, HttpStatus::NoContent);
    }

    private function delete(ServerRequestInterface $request): ServerResponseInterface
    {
        [ , , $model] = $this->setUp($request);
        $result = $model->delete($request->getId());
        return $this->setDown($result, HttpStatus::NoContent);
    }

    private function setUp(ServerRequestInterface $request): array
    {
        $storageAdapter = $this->factory->getStorageAdapter([$request->getEnvironment()['file']]);
        $dataMapper = $this->factory->getDataMapper($storageAdapter);
        $model = $this->factory->getModel($dataMapper);

        return [$storageAdapter, $dataMapper, $model];
    }

    private function setDown($result, HttpStatus $httpStatus): Response
    {
        if (false === $result) {
            throw new HttpException('', HttpStatus::InternalServerError->value);
        }
        $response = $this->factory->getResponse();
        $response->setHttpStatus($httpStatus);
        return $response;
    }
}
