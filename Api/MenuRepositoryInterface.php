<?php

namespace Shop\Api;

use Shop\Model\Menu;
use Shop\Service\Collection;

interface MenuRepositoryInterface
{
    public function getById(int $id): Menu;
    public function deleteById(int $id): void;
    public function save(Menu $menu): Menu;

    public function getCollection(?array $condition = null): Collection;
}