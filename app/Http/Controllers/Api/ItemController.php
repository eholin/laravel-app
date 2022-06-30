<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemCreateRequest;
use App\Http\Requests\ItemDeleteRequest;
use App\Http\Requests\ItemEditRequest;
use App\Http\Transformers\ItemResource;
use App\Models\Item;
use App\Services\ItemCreateService;
use App\Services\ItemDeleteService;
use App\Services\ItemEditService;
use Exception;
use Illuminate\Http\JsonResponse;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

use function response;

class ItemController extends Controller
{
    /**
     * @param ItemCreateRequest $request
     * @return ItemResource
     */
    public function create(ItemCreateRequest $request): ItemResource
    {
        $data = $request->validated();

        $service = new ItemCreateService($data);
        $item = $service->create();

        return new ItemResource($item);
    }

    /**
     * @param ItemDeleteRequest $request
     * @return JsonResponse
     */
    public function delete(ItemDeleteRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            (new ItemDeleteService((int)$data['id']))->delete();
            return response()->json(['success' => true]);
        } catch (Exception $e) {
            return response()->json(
                ['success' => false, 'message' => $e->getMessage()]
            );
        }
    }

    /**
     * @param ItemEditRequest $request
     * @return ItemResource
     */
    public function edit(ItemEditRequest $request): ItemResource
    {
        $data = $request->validated();

        $service = new ItemEditService($data);
        $item = $service->edit();

        return new ItemResource($item);
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function find(): AnonymousResourceCollection
    {
        $items = QueryBuilder::for(Item::class)
            ->join('item_categories', 'items.id', '=', 'item_categories.item_id')
            ->join('categories', 'item_categories.category_id', '=', 'categories.id')
            ->allowedFilters(
                [
                    'name',
                    'price',
                    AllowedFilter::exact('published'),
                    AllowedFilter::exact('item_categories.category_id'),
                    AllowedFilter::exact('categories.title'),
                    AllowedFilter::scope('price_between'),
                    AllowedFilter::trashed()
                ]
            )->allowedIncludes(['item_categories', 'categories'])->get();

        return ItemResource::collection($items);
    }
}
