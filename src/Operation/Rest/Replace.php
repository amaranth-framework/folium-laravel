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

namespace Itmcdev\Folium\Illuminate\Operation\Rest;

use Itmcdev\Folium\Operation\Rest\Replace as ReplaceInterface;
use Itmcdev\Folium\Operation\Exception\Update as UpdateException;
use Itmcdev\Folium\Operation\Exception\Replace as ReplaceException;
use Itmcdev\Folium\Util\ArrayUtils;

/**
 * Inteface for impelenting CRUD Replace method.
 */
class Replace extends \Itmcdev\Folium\Illuminate\Operation\Crud\Update implements ReplaceInterface
{
    /**
     * Replace a resource or set of resources in the database.
     * If a resource does not exists when passed to the update method, it will be created.
     *
     * replace([
     *   [ "text" => "I really have to iron", "id" => 10 ], // this item will be replaced
     *   [ "text" => "Do laundry" ] // this item will be created
     * ])
     *
     * @param  array $items    Can be a single element or an array of elements.
     * @param  array $options  To be defined.
     * @return array           Will return the ids of the elements updated.
     */
    public function replace(array $items, array $options = []) {
        // Obtain Model Class Name and Model Primary Key
        list($modelClass, $pKey) = $this->getModelData();
        // convert a single item into an array of items
        if (!ArrayUtils::isNumeric($items)) {
            $items = [$items];
        }

        try {
            $updated = array_map(function($item) use ($pKey, $options) {
                $criteria = empty($item[$pKey]) ? [] : [ [$pKey, $item[$pKey]] ];
                return array_pop(parent::update($item, $criteria, $options));
            }, $items);

            return $updated;
        } catch (UpdateException $e) {}

        throw new ReplaceException();
    }

    /**
     * Method is only available under CRUD and is just a reminescense under REST.
     *
     * @deprecated
     * @throws Exception
     * @see \Itmcdev\Folium\Illuminate\Operation\Crud\Update::update()
     */
    public function update(array $items, array $criteria = [], array $options = [])
    {
        throw new \Exception('Invalid method.');
    }
}

// use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\Validator;

// use Itmcdev\Folium\Exception\InvalidArgument;
// use Itmcdev\Folium\Exception\InvalidOperation;
// use Itmcdev\Folium\Exception\UnspecifiedModel;
// use Itmcdev\Folium\Exception\Validation as ValidationException;
// use Itmcdev\Folium\Illuminate\Operation\Operation;
// use Itmcdev\Folium\Operation\Rest\Replace as ReplaceInterface;
// use Itmcdev\Folium\Operation\Exception\Update as UpdateException;
// use Itmcdev\Folium\Util\ArrayUtils;
// use Itmcdev\Folium\Util\CrudUtils;

// /**
//  * Inteface for impelenting CRUD Replace method.
//  */
// class Replace implements ReplaceInterface
// {
//     /**
//      * Replace a resource or set of resources in the database.
//      * If a resource does not exists when passed to the update method, it will be created.
//      *
//      * replace([
//      *   [ "text" => "I really have to iron", "id" => 10 ], // this item will be replaced
//      *   [ "text" => "Do laundry" ] // this item will be created
//      * ])
//      *
//      * @param  array $items    Can be a single element or an array of elements.
//      * @param  array $options  To be defined.
//      * @return array           Will return the ids of the elements updated.
//      */
//     public function replace(array $items, array $options = []) {
//         // Obtain Model Class Name and Model Primary Key
//         list($modelClass, $pKey) = $this->getModelData();
//         // convert a single item into an array of items
//         if (!ArrayUtils::isNumeric($items)) {
//             $items = [$items];
//         }

//         // attempt validation (if necesary)
//         $this->validate($modelClass, $items);
//         // obtain the items we need to create (do not have primary key)
//         $itemsToCreate = array_filter($items, function ($item) use ($pKey) {
//             return empty($item[$pKey]);
//         });
//         // obtain the items we need to replace
//         $itemsToUpdate = array_filter($items, function ($item) use ($pKey) {
//             return !empty($item[$pKey]);
//         });
//         try {
//             // run update on the items having primary key
//             $updatedItems = array_map(function ($item) use ($modelClass, $pKey) {
//                 $modelClass::find($item[$pKey])->update($item);
//                 return $item[$pKey];
//             }, $itemsToUpdate);
//             // run create on the items not having primary key
//             $createdItems = [];
//             if (count($itemsToCreate)) {
//                 $createdItems = array_map(function ($item) use ($modelClass, $pKey) {
//                     return $modelClass::create($item)->$pKey;
//                 }, $itemsToCreate);
//             }
//             return array_merge($updatedItems, $createdItems);
//         } catch (\Exception $e) {
//             Log::error(sprintf('%s => %s', $e->__toString(), $e->getTraceAsString()));
//         }

//         throw new ReplaceException();
//     }
// }
