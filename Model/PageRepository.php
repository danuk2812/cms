<?php

namespace Shop\Model;

use Shop\Api\PageRepositoryInterface;
use Shop\Exceptions\NotFoundPage;
use Shop\Service\Collection;
use Shop\Service\DataBase;

class PageRepository implements PageRepositoryInterface
{

    private \Medoo\Medoo $dataBase;

    public function __construct()
    {
        $this->dataBase = DataBase::getInstance();
    }

    public function save(Page $page): Page
    {
        $savedData = [];
        foreach (Page::FIELDS as $field) {
            $savedData[$field] = $page->getData($field);
        }

        if ($savedData['id'] =='') {
            $this->dataBase->insert(Page::TABLE_NAME, $savedData);


        } else {
            $this->dataBase->update(Page::TABLE_NAME, $savedData, [
                'id' => $savedData['id']
            ]);
        }
        return $page;
    }


    public function getById(int $id): Page
    {
        $data = $this->dataBase->select(
            Page::TABLE_NAME, Page::FIELDS,
            [
                'id' => $id
            ]
        );

        if (count($data)) {
            $data = array_shift($data);
            $page = new Page();
            $page->setData($data);
            return $page;

        }

        throw new NotFoundPage('Page not found');
    }

    /**
     * @throws NotFoundPage
     */
    public function deleteById(int $id): void
    {
        $data = $this->dataBase->delete(Page::TABLE_NAME, [
            'id' => $id
        ]);

        if ($data->rowCount() == 0) {
            throw new NotFoundPage('Page not found');
        }
    }

    public function getCollection(?array $condition = null): Collection
    {
        $data = $this->dataBase->select(Page::TABLE_NAME, Page::FIELDS, $condition);
        $_items = [];
        foreach ($data as $pageData) {
            $page = new Page();
            $page->setData($pageData);
            $_items[] = $page;
        }

        return new Collection($_items);
    }
}