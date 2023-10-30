<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Spatie\Fractal\Fractal;

class CrudResponse
{
    /**
     * @var array
     */
    private array $data;

    /**
     * @var array|null
     */
    private ?array $meta;

    /**
     * @var string
     */
    private string $message;

    /**
     * @var int
     */
    private int $status_code;

    /**
     * @var array|null
     */
    private ?array $errors;

    /**
     * CrudResponse constructor.
     */
    public function __construct ()
    {
        $this->data = [];
        $this->meta = null;
        $this->message = "Successful Operation";
        $this->status_code = 200;
        $this->errors = null;
    }

    /**
     * @param int $status_code
     * @return CrudResponse
     */
    public function setStatusCode (int $status_code): CrudResponse
    {
        $this->status_code = $status_code;
        return $this;
    }

    /**
     * @param array $data
     * @return CrudResponse
     */
    public function setData (array $data): CrudResponse
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param array $meta
     * @return CrudResponse
     */
    public function setMeta (array $meta): CrudResponse
    {
        $this->meta = $meta;
        return $this;
    }

    /**
     * @param string $message
     * @return CrudResponse
     */
    public function setMessage (string $message): CrudResponse
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param array $errors
     * @return CrudResponse
     */
    public function setErrors (array $errors): CrudResponse
    {
        $this->errors = $errors;
        return $this;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function execute (): JsonResponse
    {
        return response()->json([
            'message' => $this->message,
            'data' => $this->data,
            'meta' => $this->meta,
            'errors' => $this->errors
        ])->setStatusCode($this->status_code);
    }

    /**
     * @param array $errors
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse (array $errors, string $message = "an error has encountered."): JsonResponse
    {
        $this->errors = $errors;
        $this->message  = $message;
        return $this->execute();
    }

    /**
     * @param \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Model $data
     * @param string $transformer
     * @param string $message
     * @param array $includes
     * @param array $excludes
     * @return \Illuminate\Http\JsonResponse
     */
    public function response (
        $data,
        string $transformer,
        string $message,
        array $includes = [],
        array $excludes = []
    ): JsonResponse {
        $this->mapTransformerData(
            fractal($data, new $transformer)
                ->parseIncludes($includes)
                ->parseExcludes($excludes)
        );
        $this->message  = $message;
        return $this->execute();
    }

    /**
     * @param \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Model $data
     * @param string $transformer
     * @param array $includes
     * @param array $excludes
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexResponse (
        $data,
        string $transformer,
        array $includes = [],
        array $excludes = [],
        string $message = "Data fetched successfully"
    ): JsonResponse {
        return $this->response($data, $transformer, $message, $includes, $excludes);
    }

    /**
     * @param \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Model $data
     * @param string $transformer
     * @param array $includes
     * @param array $excludes
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function showResponse (
        $data,
        string $transformer,
        array $includes = [],
        array $excludes = [],
        string $message = "Item fetched successfully"
    ): JsonResponse {
        return $this->response($data, $transformer, $message, $includes, $excludes);
    }

    /**
     * @param \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Model $data
     * @param string $transformer
     * @param array $includes
     * @param array $excludes
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function createResponse (
        $data,
        string $transformer,
        array $includes = [],
        array $excludes = [],
        string $message = "Item created successfully"
    ): JsonResponse {
        return $this->response($data, $transformer, $message, $includes, $excludes);
    }

    /**
     * @param \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Model $data
     * @param string $transformer
     * @param array $includes
     * @param array $excludes
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateResponse (
        $data,
        string $transformer,
        array $includes = [],
        array $excludes = [],
        string $message = "Item updated successfully"
    ): JsonResponse {
        return $this->response($data, $transformer, $message, $includes, $excludes);
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteResponse (string $message = "Item deleted successfully"): JsonResponse
    {
        $this->setMessage($message);
        return $this->execute();
    }

    /**
     * if data is paginated then it contains data and meta object and the usual data passed to
     * response function contains only data
     *
     * @param $data
     * @return void
     */
    private function mapTransformerData (Fractal $data)
    {
        $data = $data->toArray();
        if ($data){
            if (array_key_exists('meta', $data)){
                $this->meta = $data['meta'];
            }
            $this->data = $data['data'];
        }
    }
}
