<?php

namespace Shop\Controller\Admin\Category;

use Shop\Controller\Admin\AbstractController;
use Shop\Exceptions\NotFoundCategory;
use Shop\Model\Category;
use Shop\Model\CategoryRepository;

class Edit extends AbstractController
{
    private CategoryRepository $categoryRepository;

    public function __construct(
        \Shop\Model\AdminLogin $adminLogin,
        CategoryRepository $categoryRepository
    ) {
        parent::__construct($adminLogin);
        $this->categoryRepository = $categoryRepository;
    }

    public function execute(\Klein\Request $request, \Klein\Response $response)
    {
        try {
            $category = $this->categoryRepository->getById($request->param('id'));
        } catch (NotFoundCategory $e) {
            return $response->redirect('/admin/dashboard')->send();
        }

        return $this->render('adminhtml/editCategory.html.twig', ['category' => $category->getData()]);
    }
}