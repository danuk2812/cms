<?php

namespace Shop\Controller\Admin\Category;

use Shop\Controller\Admin\AbstractController;
use Shop\Exceptions\NotFoundCategory;
use Shop\Model\CategoryRepository;

class Delete extends AbstractController
{
    private CategoryRepository $categoryRepository;

    public function __construct(
        \Shop\Model\AdminLogin $adminLogin,
        CategoryRepository  $categoryRepository
    ){
        parent::__construct($adminLogin);
        $this->categoryRepository=$categoryRepository;
    }


    public function execute(\Klein\Request $request, \Klein\Response $response)
    {
        try {
            $this->categoryRepository->deleteById($request->param('id'));
        } catch (NotFoundCategory $e) {
            return $response->redirect('/admin/dashboard')->send();
        }
        return $response->redirect('/admin/dashboard')->send();
    }
}