<?php

namespace Shop\Model;

use Shop\Api\MenuRepositoryInterface;
use Shop\Exceptions\NotFoundMenu;
use Shop\Service\Collection;
use Shop\Service\DataBase;

class MenuRepository implements MenuRepositoryInterface
{

    private \Medoo\Medoo $dataBase;

    public function __construct()
    {
        $this->dataBase = DataBase::getInstance();
    }

    public function save(Menu $menu): Menu
    {
        $savedData = [];
        foreach (Menu::FIELDS as $field) {
            $savedData[$field] = $menu->getData($field);
        }

        if ($savedData['id'] == '') {
            $this->dataBase->insert(Menu::TABLE_NAME, $savedData);


        } else {
            $this->dataBase->update(Menu::TABLE_NAME, $savedData, [
                'id' => $savedData['id']
            ]);
        }
        return $menu;
    }


    public function getById(int $id): Menu
    {
        $data = $this->dataBase->select(
            Menu::TABLE_NAME, Menu::FIELDS,
            [
                'id' => $id
            ]
        );

        if (count($data)) {
            $data = array_shift($data);
            $menu = new Menu();
            $menu->setData($data);
            return $menu;
        }

        throw new NotFoundMenu('Menu not found');
    }

    /**
     * @throws NotFoundMenu
     */
    public function deleteById(int $id): void
    {
        $data = $this->dataBase->delete(Menu::TABLE_NAME, [
            'id' => $id
        ]);

        if ($data->rowCount() == 0) {
            throw new NotFoundMenu('Admin not found');
        }
    }

    public function getCollection(?array $condition = null): Collection
    {
        $data = $this->dataBase->select(Menu::TABLE_NAME, Menu::FIELDS, $condition);
        $_items = [];

        foreach ($data as $menuData) {
            $menu = new Menu();
            $menu->setData($menuData);
            $_items[] = $menu;
        }

        return new Collection($_items);
    }
}
