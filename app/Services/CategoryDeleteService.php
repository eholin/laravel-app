<?php

namespace App\Services;

use App\Models\Category;
use App\Models\ItemCategory;
use Exception;

class CategoryDeleteService
{
    /** @var int */
    private $categoryId;

    public function __construct(int $categoryId)
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @return void
     * @throws Exception
     */
    public function delete()
    {
        if ($this->categoryContainItems()) {
            throw new Exception('Нельзя удалить категорию, так как она прикреплена к товару');
        }

        $category = Category::whereId($this->categoryId);
        $category->delete();
    }

    /**
     * @return bool
     */
    private function categoryContainItems(): bool
    {
        return ItemCategory::whereCategoryId($this->categoryId)->exists();
    }
}
