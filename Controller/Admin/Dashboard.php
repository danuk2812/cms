<?php

namespace Shop\Controller\Admin;


use Shop\Model\CategoryRepository;
use Shop\Model\MenuRepository;
use Shop\Model\PageRepository;
use Shop\Model\PostRepository;
use Shop\Model\AdminRepository;
use Shop\Model\NewAdminRepository;


class Dashboard extends \Shop\Controller\Admin\AbstractController
{

    private CategoryRepository $categoryRepository;
    private PostRepository $postRepository;
    private AdminRepository $adminRepository;
    private PageRepository $pageRepository;
    private NewAdminRepository $newAdminRepository;
    private MenuRepository $menuRepository;


    public function __construct(
        \Shop\Model\AdminLogin $adminLogin,

        CategoryRepository     $categoryRepository,
        PostRepository         $postRepository,
        AdminRepository        $adminRepository,
        PageRepository         $pageRepository,
        NewAdminRepository $newAdminRepository,
        MenuRepository $menuRepository

    )
    {
        parent::__construct($adminLogin,$adminRepository,$menuRepository);

        $this->categoryRepository = $categoryRepository;
        $this->postRepository = $postRepository;
        $this->adminRepository = $adminRepository;
        $this->pageRepository = $pageRepository;
        $this->newAdminRepository = $newAdminRepository;
        $this->menuRepository=$menuRepository;

    }

    public function execute(\Klein\Request $request, \Klein\Response $response): string
    {
        $newAdmin = $this->newAdminRepository->getCollection()->getItemsData();
        $pageRepository = $this->pageRepository->getCollection()->getItemsData();
        $pageActive = [];
        foreach ($pageRepository as $page) {
            if ($page['status'] == '1') {
                $pageActive[] = $page;
            }
        }
        $result = '';
        parent::execute($request, $response);
        $categoryData = $this->categoryRepository->getCollection()->getItemsData();
        $postData = $this->postRepository->getCollection()->getItemsData();
        $adminData = $this->adminRepository->getCollection()->getItemsData();
        $pageData = $this->pageRepository->getCollection()->getItemsData();
        $menu = $this->menuRepository->getCollection()->getItemsData();
        if ($_SESSION['is_approved'] == 0){

            $_SESSION['message'] = 'очікуйте підтвердження адміна';
            return $response->redirect('/')->send();
        }

//        $menu = [
//            0 => [
//                'title' => 'Home',
//                'icon' => 'icon-home',
//                'link' => '/'
//            ],
//            1 => [
//                'title' => 'Dashboard',
//                'icon' => 'icon-user',
//                'link' => '/admin/dashboard'
//            ],
//            2 => [
//                'title' => 'Pages',
//                'icon' => 'icon-doc icons',
//                'link' => '/admin/page'
//            ],
//            3 => [
//                'title' => 'Categories',
//                'icon' => 'icon-notebook',
//                'link' => '/admin/category'
//            ],
//            4 => [
//                'title' => 'Posts',
//                'icon' => 'icon-pencil icons',
//                'link' => '/admin/post'
//            ]
//        ];
//        if ($_SESSION['is_approved'] == 0) {
//            $this->adminLogin->logout();
//            return $response->redirect('/admin')->send();
//        }
//
//
//        if ($_SESSION['is_approved'] == 2) {
//            $menu[] = [
//                'title' => 'Settings',
//                'icon' => 'icon-pencil icons',
//                'link' => '/admin/admin'
//            ];
//        }

        $result .= $this->render('adminhtml/dashboard.html.twig',
            [
                'categories' => $categoryData,
                'posts' => $postData,
                'users' => $adminData,
                'pages' => $pageData,
                'menu' => $_SESSION['menu'],
                'newUser' => count($newAdmin),
            ]
        );

        return $result;
    }
}