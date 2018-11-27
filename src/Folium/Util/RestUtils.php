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

namespace Itmcdev\Folium\Util\Rest;

include Itmcdev\Folium\Http\JsonResponse;

/**
 * NOTE: The bellow comment conviced me to not use HTTP statuses along with REST errors, and create my own set of 
 * error codes.
 * 
 * @link https://stackoverflow.com/a/46379701/665019
 */
class RestUtils
{

    const STATUS_SUCCESS = 'success';
    const STATUS_ERROR = 'error';

    const CODE_DUPLICATE_REQUEST = 'DUPLICATE_REQUEST';
    const CODE_GENERIC_ERROR = 'GENERIC_ERROR';
    const CODE_INVALID_REQUEST_TYPE = 'INVALID_REQUEST_TYPE';
    const CODE_INVALID_MODEL_INSTANCE = 'INVALID_MODEL_INSTANCE';
    const CODE_OK = 'OK';
    const CODE_VALIDATION_ERROR = 'VALIDATION_ERROR';
    const CODE_UNKNOWN_ERROR = 'UNKNOWN_ERROR';

    const HTTP_OK = 200;

    static $operands = [
        '$eq' => '=',
        '$ge' => '>=',
        '$gt' => '>',
        '$in' => NULL,
        '$ne' => '<>',
        '$le' => '<=',
        '$like' => 'LIKE',
        '$lt' => '<',
    ];

    /**
     * Example of Request to criteria array method. 
     * NOTE: This method will function with most SQL based languages. Please addapt it for other query languages you use
     * based on their syntax.
     *
     * @param Request $request
     * @return array
     */
    static function requestToCriteria(Request $request)
    {
        $params = $request->query->all();
        if (!empty($params['__count'])) {
            delete($params['__count']);
        }

        $params = array_map(null, array_keys($params), array_values($params));

        return array_map(function($set) {
            list($field, $value) = $set;

            if (preg_match('/([^\[]+)\[([^\]]+)\]/i', $field, $matches)) {
                $field = $matches[1];
                $operand = strtolower($matches[2]);
                if ($operand !== '$in') {
                    return [$field, self::$operands[$operand], $value];
                }
                return [$operand, json_decode($value)];
            }
            return $set;
        }, $params);
    }

    /**
     * Undocumented function
     *
     * @param any $data
     * @return JsonResponse
     */
    static function respondWithSuccess($data)
    {
        return new JsonResponse([
            'data' => $data,
            'status' => self::STATUS_SUCCESS,
            'code' => self::CODE_OK
        ], self::HTTP_OK);
    }

    /**
     * Undocumented function
     *
     * @param string $error
     * @param int    $status
     * @return JsonResponse
     */
    // static function respondWithError($error, $status = self::HTTP_BAD_REQUEST)
    static function respondWithError($error, $code = self::CODE_GENERIC_ERROR, $status = self::HTTP_OK)
    {
        return new JsonResponse([
            'message' => $error,
            'status' => self::STATUS_ERROR,
            'code' => $code
        ], $status);
    }

    static function respondWithInvalidMethod()
    {
        // return self::respondWithError('Invalid Request Method.', self::HTTP_METHOD_NOT_ALLOWED);
        return self::respondWithError('Invalid Request Method.', self::CODE_INVALID_REQUEST_TYPE);
    }

    static function respondWithUnspecifiedModel()
    {
        // return self::respondWithError('Invalid Model Instance.', self::HTTP_CONFLICT);
        return self::respondWithError('Invalid Model Instance.', self::CODE_INVALID_MODEL_INSTANCE);
    }

    static function respondWithValidationError($message)
    {
        // return self::respondWithError($message, self::HTTP_BAD_REQUEST);
        return self::respondWithError($message, self::CODE_VALIDATION_ERROR);
    }

    /**
     * Should respond for double POST/PUT
     */
    static function respondWithDuplicateRequest($message)
    {
        // return self::respondWithError($message, self::HTTP_CONFLICT);
        return self::respondWithError($message, self::CODE_DUPLICATE_REQUEST);
    }

    static function respondWithUnknownError()
    {
        return self::respondWithError('Uncaught error.', self::CODE_UNKNOWN_ERROR);
    }
}
