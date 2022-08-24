<?php

namespace Shop\Model;

use Shop\Api\RoleRepositoryInterface;
use Shop\Exceptions\NotFoundRole;
use Shop\Service\Collection;
use Shop\Service\DataBase;

class RoleRepository implements RoleRepositoryInterface
{
    private \Medoo\Medoo $dataBase;

    public function __construct()
    {
        $this->dataBase = DataBase::getInstance();
    }

    public function save(Role $role): Role
    {
        $savedData = [];
        foreach (Role::FIELDS as $field) {
            $savedData[$field] = $role->getData($field);
        }

        if ($savedData['id'] == 0) {
            $this->dataBase->insert(Role::TABLE_NAME, $savedData);


        } else {
            $this->dataBase->update(Role::TABLE_NAME, $savedData, [
                'id' => $savedData['id']
            ]);
        }
        return $role;
    }


    public function getById(int $id): Role
    {
        $data = $this->dataBase->select(
            Role::TABLE_NAME, Role::FIELDS,
            [
                'id' => $id
            ]
        );

        if (count($data)) {
            $data = array_shift($data);
            $role = new Role();
            $role->setData($data);
            return $role;
        }

        throw new NotFoundRole('Role not found');
    }

    /**
     * @throws NotFoundRole
     */
    public function deleteById(int $id): void
    {
        $data = $this->dataBase->delete(Role::TABLE_NAME, [
            'id' => $id
        ]);

        if ($data->rowCount() == 0) {
            throw new NotFoundRole('Role not found');
        }
    }

    public function getCollection(?array $condition = null): Collection
    {
        $data = $this->dataBase->select(Role::TABLE_NAME, Role::FIELDS, $condition);

        $_items = [];

        foreach ($data as $roleData) {
            $role = new Role();
            $role->setData($roleData);
            $_items[] = $role;
        }

        return new Collection($_items);
    }
}