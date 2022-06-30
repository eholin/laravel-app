<?php

namespace App\Http\Requests;

class CategoryCreateRequest extends ApiFormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
        ];
    }
}
