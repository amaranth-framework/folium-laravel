<?php

namespace Itmcdev\Folium\Rest;

trait Utils
{
    protected function isAssoc(array $array) {
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    protected function isLaravelModel($class) {
        if (!class_exists(\Illuminate\Database\Eloquent\Model)) {
            return false;
        }
        if (!is_subclass_of($class, \Illuminate\Database\Eloquent\Model)) {
            return false;
        }
        return true;
    }

    protected function isDoctrineModel($class) {
        // TODO: ...
    }
}
