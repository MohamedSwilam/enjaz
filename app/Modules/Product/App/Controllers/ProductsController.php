<?php
namespace App\Modules\Product\App\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\Facades\ApiResponse;
use App\Modules\Authentication\Domain\Models\User;
use App\Modules\Product\App\QueryBuilders\ProductQueryBuilder;
use App\Modules\Product\App\Requests\CreateProductRequest;
use App\Modules\Product\App\Requests\UpdateProductRequest;
use App\Modules\Product\App\Transformers\ProductTransformer;
use App\Modules\Product\Domain\Actions\DeleteProductAction;
use App\Modules\Product\Domain\Actions\SaveProductAction;
use App\Modules\Product\Domain\Actions\UpdateProductAction;
use App\Modules\Product\Domain\DataTransferObjects\CreateProductDto;
use App\Modules\Product\Domain\DataTransferObjects\UpdateProductDto;
use App\Modules\Product\Domain\Models\Product;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class ProductsController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(Request $request, ProductQueryBuilder $productQueryBuilder): JsonResponse
    {
        $this->authorize('browse', Product::class);

        return ApiResponse::indexResponse(
            $productQueryBuilder->paginate($request->input('paginate')?? 15),
            ProductTransformer::class
        );
    }

    /**
     * @throws AuthorizationException
     */
    public function show(Product $product): JsonResponse
    {
        $this->authorize('view', Product::class);

        return ApiResponse::showResponse($product, ProductTransformer::class);
    }

    /**
     * @throws AuthorizationException|UnknownProperties
     */
    public function store(SaveProductAction $saveProductAction, CreateProductRequest $request): JsonResponse
    {
        $this->authorize('store', Product::class);

        $product = $saveProductAction(CreateProductDto::fromRequest($request));

        return ApiResponse::createResponse($product, ProductTransformer::class);
    }

    /**
     * @throws AuthorizationException
     * @throws UnknownProperties
     */
    public function update(UpdateProductAction $updateProductAction, UpdateProductRequest $request, Product $product): JsonResponse
    {
        $this->authorize('update', User::class);

        $updateProductAction($product, UpdateProductDto::fromRequest($request));

        return ApiResponse::updateResponse($product, ProductTransformer::class);
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(DeleteProductAction $deleteProductAction, Product $product): JsonResponse
    {
        $this->authorize('destroy', Product::class);

        $deleteProductAction($product);

        return ApiResponse::deleteResponse();
    }
}
