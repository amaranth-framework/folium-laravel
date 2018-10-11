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

namespace Itmcdev\Folium\Http\Response;

use Itmcdev\Folium\Http\Response\Response;

use Symfony\Component\HttpFoundation\Response as BasicResponse;
// use Illuminate\Pagination\LengthAwarePaginator as Paginator;

/**
 * TODO:
 */
class PaginationResponse extends Response
{
    /**
     * Undocumented function
     *
     * @param \Illuminate\Pagination\LengthAwarePaginator $paginate
     * @param array $data
     */
    public function __construct($paginate, $data = []) {
        $data = array_merge($data, [
            'paginator' => [
                'total_count'  => $paginate->total(),
                'total_pages' => ceil($paginate->total() / $paginate->perPage()),
                'current_page' => $paginate->currentPage(),
                'limit' => $paginate->perPage(),
            ]
        ]);
        
        parent::__construct($data, BasicResponse::HTTP_OK, []);
    }
}
