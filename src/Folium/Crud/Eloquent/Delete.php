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

namespace Itmcdev\Folium\Crud\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

use Itmcdev\Folium\Crud\Delete as DeleteInterface;
use Itmcdev\Folium\Crud\Exception\DeleteException;
use Itmcdev\Folium\Crud\Exception\UnspecifiedModelException;

/**
 * Trait proposal for CRUD Delete method implementation on Laravel's Eloquent
 */
trait Delete
{
    use Utils;

    /**
     * @see DeleteInterface::delete()
     * @throws DeleteException
     * @throws UnspecifiedModelException
     */
    public function delete(array $items = [], array $criteria = [], array $options = [])
    {
        // delete method requires ::_modelClass variable to be able to init the model
        if (!$this->_modelClass) {
            throw new UnspecifiedModelException($this, 'delete');
        }
        $modelClass = $this->_modelClass;

        // define primary key name
        $pKey = !empty($options['p_key']) ? $options['p_key'] : 'id';

        try {
            // delete all records from table
            if (empty($items) && empty($criteria)) {
                if (empty($options['permanent']) && $this->canSoftDelete($model)) {
                    // soft delete all records if possible
                    $modelClass::all()->update(['deleted' => 1]);
                } else {
                    // otherwise fully remove
                    $modelClass::all()->delete();
                }
                return;
            }

            // delete only selected items
            if (!empty($items)) {
                // map all as model instances
                $items = array_map(function($item) {
                    if ($item instanceof $modelClass) {
                        return $item;
                    }
                    return $modelClass::find($item[$pKey]);
                }, $items);

                foreach($items as $item) {
                    if (empty($options['permanent']) && $this->canSoftDelete($model)) {
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
                
                if (empty($options['permanent']) && $this->canSoftDelete($model)) {
                    // soft delete all items if possible
                    $query->update(['deleted' => 1]);
                } else {
                    // otherwise fully remove
                    $query->delete();
                }
            }
        } catch (\Exception $e) {
            Log::error(sprintf('%s => %s', $e->__toString(), $e->getTraceAsString()));
            throw new DeleteException();
        }
    }

    /**
     * @param Model $model
     * @return boolean
     */
    protected function canSoftDelete(Model $model) {
        return method_exists($model, 'canSoftDelete') && $model->canSoftDelete();
    }
}
