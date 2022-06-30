<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryDeleteRequest;
use App\Http\Transformers\CategoryResource;
use App\Models\Category;
use App\Services\CategoryDeleteService;

use Exception;
use Illuminate\Http\JsonResponse;

use function response;

class CategoryController
{
    /**
     * @param CategoryCreateRequest $request
     * @return CategoryResource
     */
    public function create(CategoryCreateRequest $request): CategoryResource
    {
        $data = $request->validated();

        $category = new Category();
        $category->title = $data['title'];

        $category->save();

        return new CategoryResource($category);
    }

    /**
     * @param CategoryDeleteRequest $request
     * @return JsonResponse
     */
    public function delete(CategoryDeleteRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            (new CategoryDeleteService((int)$data['id']))->delete();
            return response()->json(['success' => true]);
        } catch (Exception $e) {
            return response()->json(
                ['success' => false, 'message' => $e->getMessage()]
            );
        }
    }
}
