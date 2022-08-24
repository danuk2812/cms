<?php

namespace Shop\Controller\Admin\Page;

use Shop\Controller\Admin\AbstractController;
use Shop\Exceptions\NotFoundPost;
use Shop\Model\PageRepository;

class View extends AbstractController
{
    private PageRepository $pageRepository;

    public function __construct(
        \Shop\Model\AdminLogin $adminLogin,
        PageRepository         $pageRepository
    )
    {
        parent::__construct($adminLogin);
        $this->pageRepository = $pageRepository;
    }

    public function execute(\Klein\Request $request, \Klein\Response $response)
    {
        $pageRepository = $this->pageRepository->getCollection()->getItemsData();
        $pageActive = [];
        foreach ($pageRepository as $page) {
            if ($page['status'] == '1') {
                $pageActive[] = $page;
            }
        }

        $result = $this->render('home.html.twig', ['pages' => $pageActive]);

        $page = $this->pageRepository->getById($request->param('id'));
        $result .= $this->render(
            'pageView.html.twig',
            ['pages' => $page->getData()]
        );
        return $result;
    }
}