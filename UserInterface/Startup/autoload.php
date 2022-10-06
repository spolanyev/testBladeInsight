<?php

spl_autoload_register(
    function (string $entity): void {
        $root = dirname(__DIR__, 2);
        $userInterface = $root . DIRECTORY_SEPARATOR . 'UserInterface';
        $applicationCore = $root . DIRECTORY_SEPARATOR . 'ApplicationCore';
        $middleware = $root . DIRECTORY_SEPARATOR . 'UserInterface' . DIRECTORY_SEPARATOR . 'Middleware';

        $fullPaths = [
            $applicationCore . DIRECTORY_SEPARATOR . 'Entities',
            $applicationCore . DIRECTORY_SEPARATOR . 'Interfaces',
            $middleware . DIRECTORY_SEPARATOR . 'Entities',
            $middleware . DIRECTORY_SEPARATOR . 'Handlers',
            $middleware . DIRECTORY_SEPARATOR . 'Interfaces',
            $userInterface . DIRECTORY_SEPARATOR . 'Controllers',
            $root . DIRECTORY_SEPARATOR . 'Infrastructure',
        ];

        $file = str_replace('TestBladeInsight\\', '', $entity) . '.php';
        foreach ($fullPaths as $fullPath) {
            $fullPathFile = $fullPath . DIRECTORY_SEPARATOR . $file;
            if (file_exists($fullPathFile)) {
                require $fullPathFile;
            }
        }
    }
);
