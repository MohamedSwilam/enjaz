<?php


namespace App\Modules\Product\Domain\DataTransferObjects;

use App\Modules\Product\App\Requests\CreateProductRequest;
use App\Modules\Product\App\Requests\UpdateProductRequest;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class UpdateProductDto extends DataTransferObject
{
    public string $name;

    public ?string $description;

    public ?string $image;

    public float $price;

    public ?int $parent_id;

    public string $slug;

    public bool $is_active;

    /**
     * @param UpdateProductRequest $request
     * @return UpdateProductDto
     * @throws UnknownProperties
     */
    public static function fromRequest(UpdateProductRequest $request): UpdateProductDto
    {
        $data = $request->validated();

        return new self($data);
    }
}
