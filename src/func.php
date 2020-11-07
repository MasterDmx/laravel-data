<?php

use MasterDmx\LaravelData\Data;

if (!function_exists('data')) {

    /**
     * Получить статические данные
     *
     * @param string $file
     * @return array
     */
    function data(string $alias): array
    {
        return app(Data::class)->get($alias);
    }

}
