<?php

namespace Shop\Controller;

use Shop\Model\AdminRepository;
use Shop\Model\Page;
use Shop\Model\PageRepository;
use Shop\Model\CategoryRepository;
use Shop\Model\PostRepository;
use Shop\Model\Pagination;


class Home extends HomeAbstractController
{
    const PER_PAGE = 1;

    private PostRepository $postRepository;
    private CategoryRepository $categoryRepository;
    private PageRepository $pageRepository;

    public function __construct(
        \Shop\Model\AdminLogin $adminLogin,
        AdminRepository        $adminRepository,
        PostRepository         $postRepository,
        CategoryRepository     $categoryRepository,
        PageRepository         $pageRepository
    )
    {
        parent::__construct($adminLogin, $adminRepository);
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->pageRepository = $pageRepository;

    }

    public function execute(\Klein\Request $request, \Klein\Response $response): string
    {
        $pagination = new Pagination($request->param('page'), self::PER_PAGE, $this->postRepository->count());
        $start = $pagination->getStart();
        $pageRepository = $this->pageRepository->getCollection()->getItemsData();
        $pageActive = [];
        foreach ($pageRepository as $page) {
            if ($page['status'] == '1') {
                $pageActive[] = $page;
            }
        }
        $result = $this->render('home.html.twig', ['pages' => $pageActive,'msg'=> $_SESSION['message']]);
        $where = [];
        $categoryView = (isset($_GET['category']) != NULL) ? $_GET['category'] : '';
        if ($categoryView != 0) {
            $where = [
                'category' => $categoryView
            ];
        }
        if (empty($where)) {
            $data = $this->postRepository->getCollection(["LIMIT" => [$start, self::PER_PAGE]])->getItemsData();
        } else {
            $data = $this->postRepository->getCollection($where)->getItemsData();
            $pagination = '';
        }


        $categoryData = $this->categoryRepository->getCollection()->getItemsData();
        foreach ($categoryData as $key => $value) {
            $categoryArr [$value['id']] = $value['name'];
        }
        $i = 0;

        foreach ($data as $item) {
            $substr = substr($data[$i]['description'], 0, 200);
            $data[$i]['description'] = $substr;
            $last_space = strrpos($substr, ' ');
            if ($last_space !== false) {
                $data[$i]['description'] = substr($substr, 0, $last_space) . "...";

            }
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
            'postView.html.twig',
            ['postData' => $data, 'category' => $categoryData],
        );
        return $result . $pagination;
    }
}