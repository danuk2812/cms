<?php

namespace Shop\Api;

use Shop\Model\Role;
use Shop\Service\Collection;

interface RoleRepositoryInterface
{
    public function getById(int $id): Role;
    public function deleteById(int $id): void;
    public function save(Role $category): Role;

    public function getCollection(?array $condition = null): Collection;
}