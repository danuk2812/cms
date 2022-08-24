<?php

namespace Shop\Service;

class Collection extends DataObject
{
    private array $_items = [];

    public function __construct($_items = [], $data = [])
    {
        $this->setItems($_items);
        parent::__construct($data);
    }

    public function getItems(): array
    {
        return $this->_items;
    }

    public function getSize(): int
    {
        return count($this->_items);
    }

    public function setItems($items): Collection
    {
        $this->_items = $items;
        return $this;
    }

    public function getItemsData(): array
    {
        $data = [];
        foreach ($this->_items as $item) {
            $data[] = $item->getData();
        }
        return $data;
    }
}