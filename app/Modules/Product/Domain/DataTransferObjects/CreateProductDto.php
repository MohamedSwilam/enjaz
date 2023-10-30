<?php


namespace App\Modules\Product\Domain\DataTransferObjects;

use App\Modules\Product\App\Requests\CreateProductRequest;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class CreateProductDto extends DataTransferObject
{
    public string $name;

    public ?string $description;

    public ?string $image;

    public float $price;

    public ?int $parent_id;

    public string $slug;

    public bool $is_active;

    /**
     * @param CreateProductRequest $request
     * @return CreateProductDto
     * @throws UnknownProperties
     */
    public static function fromRequest(CreateProductRequest $request): CreateProductDto
    {
        $data = $request->validated();

        return new self($data);
    }
}
