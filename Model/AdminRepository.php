<?php

namespace Shop\Model;

use Shop\Api\AdminRepositoryInterface;
use Shop\Exceptions\NotFoundAdmin;
use Shop\Service\Collection;
use Shop\Service\DataBase;

class AdminRepository implements AdminRepositoryInterface
{

    private \Medoo\Medoo $dataBase;

    public function __construct()
    {
        $this->dataBase = DataBase::getInstance();
    }

    public function save(Admin $admin): Admin
    {
        $savedData = [];

        foreach (Admin::FIELDS as $field) {
            $savedData[$field] = $admin->getData($field);
        }

        if ($savedData['id'] =='') {
            $this->dataBase->insert(Admin::TABLE_NAME, $savedData);
        } else {
            $this->dataBase->update(Admin::TABLE_NAME, $savedData, [
                'id' => $savedData['id']
            ]);
        }

        return $admin;
    }


    public function getById(int $id): admin
    {
        $data = $this->dataBase->select(
            Admin::TABLE_NAME, Admin::FIELDS,
            [
                'id' => $id
            ]
        );

        if (count($data)) {
            $data = array_shift($data);
            $admin = new Admin();
            $admin->setData($data);
            return $admin;
        }

        throw new NotFoundAdmin('Admin not found');
    }

    /**
     * @throws NotFoundAdmin
     */
    public function deleteById(int $id): void
    {
        $data = $this->dataBase->delete(Admin::TABLE_NAME, [
            'id' => $id
        ]);

        if ($data->rowCount() == 0) {
            throw new NotFoundAdmin('Admin not found');
        }
    }

    public function getCollection(?array $condition = null): Collection
    {
        $data = $this->dataBase->select(Admin::TABLE_NAME, Admin::FIELDS, $condition);
        $_items = [];

        foreach ($data as $adminData) {
            $admin = new Admin();
            $admin->setData($adminData);
            $_items[] = $admin;
        }

        return new Collection($_items);
    }
}