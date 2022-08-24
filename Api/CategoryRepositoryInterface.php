<?php

namespace Shop\Api;

use Shop\Model\Category;
use Shop\Service\Collection;

interface CategoryRepositoryInterface
{
    public function getById(int $id): Category;
    public function deleteById(int $id): void;
    public function save(Category $category): Category;

    public function getCollection(?array $condition = null): Collection;
}