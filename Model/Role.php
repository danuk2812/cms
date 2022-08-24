<?php

namespace Shop\Model;

use Shop\Service\DataObject;

class Role extends DataObject
{

    const TABLE_NAME = 'role';
    const FIELDS = [ 'id', 'permission'];

    public function getId(): int
    {
        return (int) $this->_data['id'];
    }
    public function getPermission(): string
    {
        return $this->_data['permission'];
    }
    public function setPermission(string $permission): Role
    {
        $this->_data['permission'] = $permission;
        return $this;
    }
}