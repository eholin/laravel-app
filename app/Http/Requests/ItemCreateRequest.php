<?php

namespace App\Http\Requests;

class ItemCreateRequest extends ApiFormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'price' => 'required|numeric',
            'categories' => 'array',
        ];
    }
}
