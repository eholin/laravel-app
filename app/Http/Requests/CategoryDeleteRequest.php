<?php

namespace App\Http\Requests;

class CategoryDeleteRequest extends ApiFormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:categories,id',
        ];
    }
}
