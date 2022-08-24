<?php

namespace Shop\Controller\Admin\Category;

use Shop\Controller\Admin\AbstractController;
use Shop\Model\CategoryRepository;
use Shop\Model\MenuRepository;



class Dashboard extends AbstractController
{
    private CategoryRepository $categoryRepository;
    private MenuRepository $menuRepository;


    public function __construct(
        \Shop\Model\AdminLogin $adminLogin,

        CategoryRepository     $categoryRepository,
        MenuRepository     $menuRepository

    )
    {
        parent::__construct($adminLogin);
        $this->categoryRepository = $categoryRepository;
        $this->menuRepository = $menuRepository;

    }

    public function execute(\Klein\Request $request, \Klein\Response $response)
    {
        $menu = [
            0 => [
                'title' => 'Home',
                'icon' => 'icon-home',
                'link' => '/'
            ],
            1 => [
                'title' => 'Dashboard',
                'icon' => 'icon-user',
                'link' => '/admin/dashboard'
            ],
            2 => [
                'title' => 'Pages',
                'icon' => 'icon-doc icons',
                'link' => '/admin/page'
            ],
            4 => [
                'title' => 'Posts',
                'icon' => 'icon-pencil icons',
                'link' => '/admin/post'
            ]
        ];
        if ($_SESSION['is_approved'] == 0) {
            $this->adminLogin->logout();
            return $response->redirect('/admin')->send();
        }


        if ($_SESSION['is_approved'] == 2) {
            $menu[] = [
                'title' => 'Settings',
                'icon' => 'icon-pencil icons',
                'link' => '/admin/admin'
            ];
        }
        parent::execute($request, $response);
        $result = $this->render('adminhtml/category.html.twig', [ 'menu' => $menu]);
        $categoryData = $this->categoryRepository->getCollection()->getItemsData();
        $menuData = $this->menuRepository->getCollection()->getItemsData();
        $result .= $this->render('adminhtml/listing/categoryView.html.twig',
            ['categories' => $categoryData,]
        );
        return $result;
    }
}