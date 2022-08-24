<?php

namespace Shop\Api;

use Shop\Model\Page;
use Shop\Service\Collection;

interface PageRepositoryInterface
{
    public function getById(int $id): Page;
    public function deleteById(int $id): void;
    public function save(Page $page): Page;

    public function getCollection(?array $condition = null): Collection;
}