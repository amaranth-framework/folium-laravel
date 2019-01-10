<?php

namespace Itmcdev\Folium\Illuminate\Tests\Group\Rest;

use Itmcdev\Folium\Illuminate\Operation\Rest\Create;
use Itmcdev\Folium\Illuminate\Operation\Rest\Fetch;
use Itmcdev\Folium\Illuminate\Operation\Rest\Retreive;
use Itmcdev\Folium\Illuminate\Operation\Rest\Update;
use Itmcdev\Folium\Illuminate\Operation\Rest\Replace;
use Itmcdev\Folium\Illuminate\Operation\Rest\Delete;

class Group extends \Itmcdev\Folium\Operation\Group\Rest
{
    /**
     * REST Group Constructor
     *
     * @param Create $create
     * @param Fetch $fetch
     * @param Retreive $retreive
     * @param Update $update
     * @param Replace $replace
     * @param Delete $delete
     * @param string $modelClass
     */
    public function __construct(
        Create $create,
        Fetch $fetch,
        Retreive $retreive,
        Update $update,
        Replace $replace,
        Delete $delete,
        string $modelClass
    ) {
        $this->setCreate($create)
            ->setFetch($fetch)
            ->setRetreive($retreive)
            ->setUpdate($update)
            ->setReplace($replace)
            ->setDelete($delete)
            ->setModelClass($modelClass);
    }
}
