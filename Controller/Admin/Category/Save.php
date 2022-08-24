<?php

namespace Shop\Controller\Admin\Category;

use Shop\Controller\Admin\AbstractController;
use Shop\Model\Category;
use Shop\Model\CategoryRepository;


class Save extends AbstractController
{
    private CategoryRepository  $categoryRepository;

    public function __construct(
        \Shop\Model\AdminLogin $adminLogin,
        CategoryRepository$categoryRepository
    ) {
        parent::__construct($adminLogin);
        $this->categoryRepository = $categoryRepository;
    }

    public function execute(\Klein\Request $request, \Klein\Response $response)
    {
        $data = $request->paramsPost()->all();
        $category = new Category();
        $category->setData($data);
        $this->categoryRepository->save($category);

        $response->redirect('/admin/dashboard')->send();
    }
}