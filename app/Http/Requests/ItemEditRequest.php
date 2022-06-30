<?php

namespace App\Http\Requests;

class ItemEditRequest extends ApiFormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:items,id',
            'name' => 'string',
            'price' => 'numeric',
            'published' => 'boolean',
            'categories' => 'array',
        ];
    }
}
