<?php

namespace Shop\Model;

use Shop\Api\NewAdminRepositoryInterface;
use Shop\Exceptions\NotFoundAdmin;
use Shop\Service\Collection;
use Shop\Service\DataBase;


class NewAdminRepository implements NewAdminRepositoryInterface
{

    private \Medoo\Medoo $dataBase;

    public function __construct()
    {
        $this->dataBase = DataBase::getInstance();
    }

    public function save(NewAdmin $newAdmin): NewAdmin
    {
        $savedData = [];

        foreach (NewAdmin::FIELDS as $field) {
            $savedData[$field] = $newAdmin->getData($field);
        }

        $this->dataBase->insert(NewAdmin::TABLE_NAME, $savedData);

        return $newAdmin;
    }


    public function getById(int $id): NewAdmin
    {
        $data = $this->dataBase->select(
            NewAdmin::TABLE_NAME, NewAdmin::FIELDS,
            [
                'id' => $id
            ]
        );

        if (count($data)) {
            $data = array_shift($data);
            $newAdmin = new NewAdmin();
            $newAdmin->setData($data);
            return $newAdmin;
        }

        throw new NotFoundAdmin('New Admin not found');
    }

    /**
     * @throws NotFoundAdmin
     */
    public function deleteById(int $id): void
    {
        $data = $this->dataBase->delete(NewAdmin::TABLE_NAME, [
            'id' => $id
        ]);

        if ($data->rowCount() == 0) {
            throw new NotFoundAdmin('New Admin not found');
        }
    }

    public function getCollection(?array $condition = null): Collection
    {
        $data = $this->dataBase->select(NewAdmin::TABLE_NAME, NewAdmin::FIELDS, $condition);

        $_items = [];
        foreach ($data as $newAdminData) {
            $newAdmin = new NewAdmin();
            $newAdmin->setData($newAdminData);
            $_items[] = $newAdmin;
        }

        return new Collection($_items);
    }
}