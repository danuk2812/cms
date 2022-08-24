<?php

namespace Shop\Controller\Admin\Page;

use Shop\Controller\Admin\AbstractController;
use Shop\Model\PageRepository;
use Shop\Model\PostRepository;


class Dashboard extends AbstractController
{
    private PageRepository $pageRepository;

    public function __construct(
        \Shop\Model\AdminLogin $adminLogin,
        PostRepository         $postRepository,


        PageRepository         $pageRepository
    )
    {
        parent::__construct($adminLogin);
        $this->pageRepository = $pageRepository;
        $this->postRepository = $postRepository;
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
            3 => [
                'title' => 'Categories',
                'icon' => 'icon-notebook',
                'link' => '/admin/category'
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
            $i = 0;
            $pageData = $this->pageRepository->getCollection()->getItemsData();
            foreach ($pageData as $item) {
                $a = substr($pageData[$i]['content'], 0, 200);
                $last_space = strrpos($a, ' ');
                $pageData[$i]['content'] = substr($a, 0, $last_space);
                $i = $i + 1;
            }
            $result = $this->render('adminhtml/page.html.twig', ['menu' => $menu]);
            parent::execute($request, $response);
            $pageRepository = $this->pageRepository->getCollection()->getItemsData();
            $result .= $this->render('adminhtml/listing/pageView.html.twig', ['pages' => $pageData]);
            return $result;
        }
    }
