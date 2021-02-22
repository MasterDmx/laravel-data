<?php

namespace MasterDmx\LaravelData;

use Exception;
use InvalidArgumentException;

class Data
{
    private $memory = [];

    /**
     * Получить данные
     *
     * @param string $alias
     * @return array
     */
    public function get(string $alias): array
    {
        if ($this->hasInMemory($alias)) {
            return $this->getFromMemory($alias);
        }

        $path = $this->getPath($alias);

        if (!file_exists($path)) {
            throw new InvalidArgumentException('File ' . $alias . ' not found');
        }

        $data = include $path;

        if (!is_array($data)) {
            throw new Exception('Data in file ' . $alias . ' is not array');
        }

        return $this->saveInMemory($alias, $data);
    }

    /**
     * Получить путь до файла по алиасу
     *
     * @param string $alias
     * @return string
     */
    public function getPath(string $alias): string
    {
        return resource_path('data' . DIRECTORY_SEPARATOR . str_ireplace('.', DIRECTORY_SEPARATOR, $alias) . '.php');
    }

    private function hasInMemory(string $alias): bool
    {
        return isset($this->storage[$alias]);
    }

    private function getFromMemory(string $alias): array
    {
        return $this->storage[$alias];
    }

    private function saveInMemory(string $alias, array $data): array
    {
        return $this->storage[$alias] = $data;
    }
}
