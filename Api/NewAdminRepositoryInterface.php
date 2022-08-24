<?php

namespace Shop\Api;

use Shop\Model\NewAdmin;
use Shop\Service\Collection;

interface NewAdminRepositoryInterface
{
    public function getById(int $id): NewAdmin;
    public function deleteById(int $id): void;
    public function save(NewAdmin $newAdmin): NewAdmin;

    public function getCollection(?array $condition = null): Collection;
}