<?php

namespace App\Http\Responses\Facades;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Facade;

/**
 * @method static JsonResponse response($data, string $transformer, string $message, array $includes = [], array $excludes = [])
 * @method static JsonResponse showResponse($data, string $transformer, array $includes = [], array $excludes = [], string $message = "Item fetched successfully")
 * @method static JsonResponse indexResponse($data, string $transformer, array $includes = [], array $excludes = [], string $message = "Data fetched successfully")
 * @method static JsonResponse createResponse($data, string $transformer, array $includes = [], array $excludes = [], string $message = "Item created successfully")
 * @method static JsonResponse updateResponse($data, string $transformer, array $includes = [], array $excludes = [], string $message = "Item updated successfully")
 * @method static JsonResponse deleteResponse(string $message = "Item deleted successfully")
 * @method static JsonResponse errorResponse(array $errors, string $message = "an error has encountered.")
 * @method static ApiResponse setErrors (array $errors)
 * @method static ApiResponse setMessage (string $message)
 * @method static ApiResponse setMeta (array $meta)
 * @method static ApiResponse setData (array $data)
 * @method static JsonResponse execute ()
 * @method static ApiResponse setStatusCode (int $status_code)
 *
 */

class ApiResponse extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'CrudResponse';
    }
}
