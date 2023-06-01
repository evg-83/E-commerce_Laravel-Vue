<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title'         => 'required|string',
            'description'   => 'required|string',
            'content'       => 'required|string',
            'preview_image' => 'nullable|file',
            'price'         => 'required|integer',
            'count'         => 'required|integer',
            'is_published'  => 'nullable|boolean',
            'category_id'   => 'nullable|integer|exists:categories,id',
            'tags'          => 'nullable|array',
            'tags.*'        => 'nullable|integer|exists:tags,id',
            'colors'        => 'nullable|array',
            'colors.*'      => 'nullable|integer|exists:colors,id',
        ];
    }
}
