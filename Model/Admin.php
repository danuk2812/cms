<?php

namespace Shop\Model;

use Shop\Service\DataObject;

class Admin extends DataObject
{
    const TABLE_NAME = 'user';
    const FIELDS = ['password', 'login', 'is_approved','id'];

    public function getPassword(): string
    {
        return $this->_data['password'];
    }

    public function setPassword(string $password): Admin
    {
        $this->_data['password'] = $password;
        return $this;
    }

    public function getLogin(): string
    {
        return $this->_data['login'];
    }

    public function setLogin(string $login): Admin
    {
        $this->_data['login'] = $login;
        return $this;
    }

    public function getApproved(): string
    {
        return $this->_data['is_approved'];
    }

    public function setApproved(string $approved): Admin
    {
        $this->_data['is_approved'] = $approved;
        return $this;
    }
    public function getId(): string
    {
        return $this->_data['id'];
    }

    public function setId(string $id): Admin
    {
        $this->_data['id'] = $id;
        return $this;
    }
}