<?php

namespace App\Http\Requests;

class ItemDeleteRequest extends ApiFormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:items,id',
        ];
    }
}
