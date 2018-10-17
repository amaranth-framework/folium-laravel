<?php

namespace Itmcdev\Folium\Rest;

trait Utils
{

    static $operands = [
        '$eq' => '=',
        '$lt' => '<',
        '$lte' => '<=',
        '$gt' => '>',
        '$gte' => '>',
        '$ne' => '!=',
        '$like' => 'LIKE',
    ];

    /**
     * @param array $array
     * @return bool
     */
    protected function isAssoc(array $array) {
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    /**
     * @param array $filters
     */
    protected function parseFilters(array $filters)
    {
        $parsedFilters = [];
        foreach ($filters as $filterKey => $filterValue) {
            if (preg_match('/([ˆ\[]+)\[([ˆ\]]+)\]/', $filter, $matches)) {
                if (defined(self::$operands, $matches[2])) {
                    $parsedFilters[] = [ $matches[1], $matches[2], $filterValue ];
                } else {
                    throw new UnknownOperand($matches[2]);
                }
            } else {
                $parsedFilters[] = [ $filterKey, $filterValue ];
            }
        }
        return $parsedFilters;
    }
}
