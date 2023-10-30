<?php
namespace App\Modules\Product\App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'string',
                'max:255',
            ],
            'image' => [
                'string',
                'max:255',
            ],
            'price' => [
                'required',
                'numeric',
            ],
            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:products,slug',
            ],
            'is_active' => [
                'required',
                'boolean',
            ],
        ];
    }
}
