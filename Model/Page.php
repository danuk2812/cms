<?php

namespace Shop\Model;

use Shop\Service\DataObject;

class Page extends DataObject
{
    const TABLE_NAME = 'page';
    const FIELDS = ['id', 'content', 'title','status'];

    public function getContent(): string
    {
        return $this->_data['content'];
    }

    public function setContent(string $content): Page
    {
        $this->_data['content'] = $content;
        return $this;
    }

    public function getTile(): string
    {
        return $this->_data['title'];
    }

    public function setTile(string $title): Page
    {
        $this->_data['title'] = $title;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->_data['status'];
    }

    public function setStatus(string $status): Page
    {
        $this->_data['status'] =$status;
        return $this;
    }
    public function getId(): string
    {
        return $this->_data['id'];
    }

    public function setId(string $id): Page
    {
        $this->_data['id'] = $id;
        return $this;
    }
}