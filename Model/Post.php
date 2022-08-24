<?php

namespace Shop\Model;

use Shop\Service\DataObject;

class Post extends DataObject
{
    const TABLE_NAME = 'post';
    const FIELDS = ['entity_id', 'title', 'description', 'category','picture'];

    public function getId(): int
    {
        return (int) $this->_data['entity_id'];
    }

    public function getTitle(): string
    {
        return $this->_data['title'];
    }

    public function setTitle(string $title): Post
    {
        $this->_data['title'] = $title;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->_data['description'];
    }

    public function setDescription($description): Post
    {
        $this->_data['description'] = $description;
        return $this;
    }

    public function getCategory(): float
    {
        return (float) $this->_data['category'];
    }

    public function setCategory($category): Post
    {
        $this->_data['category'] = $category;
        return $this;
    }
    public function getPicture()
    {
        return $this->_data['picture'];
    }

    public function setPicture($picture): Post
    {

        $this->_data['picture'] = $picture;
        return $this;
    }
}