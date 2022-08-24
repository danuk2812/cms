<?php

namespace Shop\Model;

use Shop\Api\CategoryRepositoryInterface;

use Shop\Exceptions\NotFoundCategory;
use Shop\Service\Collection;
use Shop\Service\DataBase;

class CategoryRepository implements CategoryRepositoryInterface
{

    private \Medoo\Medoo $dataBase;

    public function __construct()
    {
        $this->dataBase = DataBase::getInstance();
    }

    public function save(Category $category): Category
    {
        $savedData = [];
        foreach (Category::FIELDS as $field) {
            $savedData[$field] = $category->getData($field);
        }

        if ($savedData['id'] == 0) {
            $this->dataBase->insert(Category::TABLE_NAME, $savedData);


        } else {
            $this->dataBase->update(Category::TABLE_NAME, $savedData, [
                'id' => $savedData['id']
            ]);
        }
        return $category;
    }


    public function getById(int $id): Category
    {
        $data = $this->dataBase->select(
            Category::TABLE_NAME, Category::FIELDS,
            [
                'id' => $id
            ]
        );

        if (count($data)) {
            $data = array_shift($data);
            $category = new Category();
            $category->setData($data);
            return $category;
        }

        throw new NotFoundCategory('Category not found');
    }

    /**
     * @throws NotFoundCategory
     */
    public function deleteById(int $id): void
    {
        $data = $this->dataBase->delete(Category::TABLE_NAME, [
            'id' => $id
        ]);

        if ($data->rowCount() == 0) {
            throw new NotFoundCategory('Category not found');
        }
    }

    public function getCollection(?array $condition = null): Collection
    {
        $data = $this->dataBase->select(Category::TABLE_NAME, Category::FIELDS, $condition);

        $_items = [];

        foreach ($data as $categoryData) {
            $category = new Category();
            $category->setData($categoryData);
            $_items[] = $category;
        }

        return new Collection($_items);
    }
}