<?php

namespace Shop\Controller\Admin\Post;

use Shop\Controller\AbstractController;
use Shop\Model\PostRepository;
use Shop\Model\CategoryRepository;


class Dashboard extends AbstractController
{
    private PostRepository $postRepository;
    private CategoryRepository $categoryRepository;

    public function __construct(
        \Shop\Model\AdminLogin $adminLogin,

        PostRepository         $postRepository,
        CategoryRepository     $categoryRepository
    )
    {
        parent::__construct($adminLogin);
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
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
            3 => [
                'title' => 'Categories',
                'icon' => 'icon-notebook',
                'link' => '/admin/category'
            ],
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

        $result = $this->render('adminhtml/post.html.twig',['menu'=>$menu]);


        $where = [];
        $categoryView = (isset($_GET['category']) != NULL) ? $_GET['category'] : '';
        if ($categoryView != 0) {
            $where = [
                'category' => $categoryView
            ];
        }
        if (empty($where)) {
            $data = $this->postRepository->getCollection()->getItemsData();
        } else {
            $data = $this->postRepository->getCollection($where)->getItemsData();
//            $pagination ='';
        }


        $categoryData = $this->categoryRepository->getCollection()->getItemsData();
        foreach ($categoryData as $key => $value) {
            $categoryArr [$value['id']] = $value['name'];
        }
        $i = 0;

        foreach ($data as $item) {
            $a = substr($data[$i]['description'], 0, 200);
            $last_space = strrpos($a, ' ');
            $data[$i]['description'] = substr($a, 0, $last_space);
            if (!isset($categoryArr[$item["category"]])) {
                $data[$i]["category"] = 'Not found category';
            } else {
                $data[$i]["category_id"] = $data[$i]["category"];
                $data[$i]["category"] = $categoryArr[$item["category"]];
            }
            $item["picture"] = addslashes(base64_encode($item["picture"]));
            $data[$i]["picture"] = $item["picture"];

            $i = $i + 1;
        }

        $result .= $this->render(
            'adminhtml/listing/postView.html.twig',
            ['postData' => $data, 'category' => $categoryData],
        );
        return $result;

    }
}