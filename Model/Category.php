<?php

namespace Shop\Model;

use Shop\Service\DataObject;

class Category extends DataObject
{
    const TABLE_NAME = 'category';
    const FIELDS = [ 'id', 'name'];

    public function getId(): int
    {
        return (int) $this->_data['id'];
    }
    public function getName(): string
    {
        return $this->_data['name'];
    }
    public function setName(string $name): Category
    {
        $this->_data['name'] = $name;
        return $this;
    }
}
