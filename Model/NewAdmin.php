<?php

namespace Shop\Model;

use Shop\Service\DataObject;

class NewAdmin extends DataObject
{
    const TABLE_NAME = 'new_user';
    const FIELDS = ['id', 'message'];

    public function getId(): string
    {
        return $this->_data['id'];
    }

    public function setId(string $id): NewAdmin
    {
        $this->_data['id'] = $id;
        return $this;
    }

    public function getMessage(): string
    {
        return $this->_data['message'];
    }

    public function setMessage(string $message): NewAdmin
    {
        $this->_data['message'] = $message;
        return $this;
    }

    public function getLogin(): string
    {
        return $this->_data['login'];
    }

    public function setLogin(string $login): NewAdmin
    {
        $this->_data['login'] = $login;
        return $this;
    }

    public function getApproved(): string
    {
        return $this->_data['is_approved'];
    }

    public function setApproved(string $approved): NewAdmin
    {
        $this->_data['is_approved'] = $approved;
        return $this;
    }

}