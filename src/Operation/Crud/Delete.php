<?php
/**
 * Copyright 2018 IT Media Connect
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Itmcdev\Folium\Illuminate\Operation\Crud;

use Illuminate\Support\Facades\Log;

use Itmcdev\Folium\Exception\UnspecifiedModel;
use Itmcdev\Folium\Exception\UnspecifiedModelKey;
use Itmcdev\Folium\Operation\Crud\Delete as DeleteInterface;
use Itmcdev\Folium\Operation\Exception\Delete as DeleteException;
use Itmcdev\Folium\Operation\Operation;
use Itmcdev\Folium\Util\CrudUtils;

/**
 * Class proposal for CRUD Delete operation implementation on Laravel's Eloquent
 */
class Delete extends Operation implements DeleteInterface
{
    /**
     * @see DeleteInterface::delete()
     * @throws DeleteException
     * @throws UnspecifiedModel
     * @throws UnspecifiedModelKey
     */
    public function delete(
        array $items = [],
        array $criteria = [],
        array $options = []
    ) {
        // delete method requires ::modelClass variable to be able to init the model
        if (!$this->modelClass) {
            throw new UnspecifiedModel($this, 'delete');
        }
        $modelClass = $this->modelClass;
        // define primary key name
        $pKey = (new $modelClass())->getKeyName();
        if (!$pKey) {
            throw new UnspecifiedModelKey($modelClass, $this, 'delete');
        }
        try {
            // delete all records from table
            if (empty($items) && empty($criteria)) {
                if (
                    empty($options['permanent']) &&
                    CrudUtils::canSoftDelete($modelClass)
                ) {
                    // soft delete all records if possible
                    $modelClass::all()->update(['deleted' => 1]);
                } else {
                    // otherwise fully remove
                    $modelClass
                        ::query()
                        ->where($pKey, '>', 0)
                        ->delete();
                }
                return;
            }
            // delete only selected items
            if (!empty($items)) {
                // map all as model instances
                $items = $modelClass::find(
                    array_map(function ($item) use ($pKey) {
                        return $item[$pKey];
                    }, $items)
                );

                foreach ($items as $item) {
                    if (
                        empty($options['permanent']) &&
                        CrudUtils::canSoftDelete($modelClass)
                    ) {
                        // soft delete each item if possible
                        $item->update(['deleted' => 1]);
                    } else {
                        // otherwise fully remove
                        $item->delete();
                    }
                }
                return;
            }
            // delete items based on criteria
            if (!empty($criteria)) {
                // build a query based on the criteria
                $query = $modelClass::query();
                foreach ($criteria as $item) {
                    $query = call_user_func_array([$query, 'where'], $item);
                }

                if (
                    empty($options['permanent']) &&
                    CrudUtils::canSoftDelete($modelClass)
                ) {
                    // soft delete all items if possible
                    $query->update(['deleted' => 1]);
                } else {
                    // otherwise fully remove
                    $query->delete();
                }
            }
        } catch (\Exception $e) {
            Log::error(
                sprintf('%s => %s', $e->__toString(), $e->getTraceAsString())
            );
        }
        throw new DeleteException();
    }
}
