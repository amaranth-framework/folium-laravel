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
    use \Itmcdev\Folium\Illuminate\Util\Crud;

    /**
     * @see DeleteInterface::delete()
     * @throws DeleteException
     * @throws UnspecifiedModel
     * @throws UnspecifiedModelKey
     */
    public function delete(array $items = [], array $criteria = [], array $options = [])
    {
        // Obtain Model Class Name and Model Primary Key
        list($modelClass, $pKey) = $this->getModelData();
        // Whether to permanent delete
        $notPermanentDelete = empty($options[CrudUtils::permanentDeleteProperty()]);
        try {
            // delete all records from table
            if (empty($items) && empty($criteria)) {
                if ($notPermanentDelete && CrudUtils::canSoftDelete($modelClass)) {
                    // soft delete all records if possible
                    $modelClass::all()->update([CrudUtils::deletedProperty() => 1]);
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
                $items = array_map(function ($item) use ($pKey) {
                    return $item[$pKey];
                }, $items);
                $criteria[] = [$pKey, $items];
            }
            // delete items based on criteria
            if (!empty($criteria)) {
                // attempt to query by criteria (convert criteria into callable code)
                $query = $this->buildQueryFromCriteria($modelClass, $criteria);
                if ($notPermanentDelete && CrudUtils::canSoftDelete($modelClass)) {
                    // soft delete all items if possible
                    $query->update([CrudUtils::deletedProperty() => 1]);
                } else {
                    // otherwise fully remove
                    $query->delete();
                }
                return;
            }
        } catch (\Exception $e) {
            Log::error(sprintf('%s => %s', $e->__toString(), $e->getTraceAsString()));
        }
        throw new DeleteException();
    }
}
