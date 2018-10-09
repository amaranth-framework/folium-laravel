<?php

namespace Folium\Rest;

trait Utils
{
    protected function isAssoc(array $array) {
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}