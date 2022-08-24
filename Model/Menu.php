<?php

namespace Shop\Model;

use Shop\Service\DataObject;

class Menu extends DataObject
{
    const TABLE_NAME = 'menu';
    const FIELDS = [ 'title', 'icon','link'];

    public function getTitle(): int
    {
        return (int) $this->_data['title'];
    }
    public function setTitle(string $title): Menu
    {
        $this->_data['title'] = $title;
        return $this;
    }
    public function getLink(): int
    {
        return (int) $this->_data['link'];
    }
    public function setLink(string $link): Menu
    {
        $this->_data['link'] = $link;
        return $this;
    }
    public function getIcon(): int
    {
        return (int) $this->_data['icon'];
    }
    public function setIcon(string $icon): Menu
    {
        $this->_data['icon'] = $icon;
        return $this;
    }
}
