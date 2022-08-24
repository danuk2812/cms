<?php

namespace Shop\Api;

use Shop\Model\Post;
use Shop\Service\Collection;

interface PostRepositoryInterface
{
    public function getById(int $id): Post;
    public function deleteById(int $id): void;
    public function save(Post $post): Post;

    public function getCollection(?array $condition = null): Collection;
}