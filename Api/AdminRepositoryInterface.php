<?php

namespace Shop\Api;

use Shop\Model\Admin;
use Shop\Service\Collection;

interface AdminRepositoryInterface
{
    public function getById(int $id): Admin;
    public function deleteById(int $id): void;
    public function save(Admin $admin): Admin;

    public function getCollection(?array $condition = null): Collection;
}