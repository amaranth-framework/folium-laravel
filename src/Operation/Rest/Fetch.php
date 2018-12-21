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

use Itmcdev\Folium\Operation\Exception\Fetch as FetchException;
use Itmcdev\Folium\Operation\Exception\Read as ReadException;
use Itmcdev\Folium\Operation\Rest\Fetch as FetchInterface;

/**
 * Class proposal for REST Fetch operation implementation on Laravel's Eloquent
 */
class Fetch extends \Itmcdev\Folium\Illuminate\Operation\Crud\Read implements FetchInterface
{
    /**
     * @see FetchInterfacee::fetch()
     * @throws FetchException
     * @throws InvalidArgument
     * @throws UnspecifiedModel
     */
    public function list(array $criteria = [], array $fields = [], array $options = [])
    {
        try {
            return $this->read($criteria, $fields, $options);
        } catch (ReadException $e) {}

        throw new FetchException();
    }
}
