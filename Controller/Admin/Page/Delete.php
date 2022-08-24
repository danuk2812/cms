<?php

namespace Shop\Controller\Admin\Page;

use Shop\Controller\Admin\AbstractController;
use Shop\Exceptions\NotFoundCategory;
use Shop\Exceptions\NotFoundPage;
use Shop\Model\PageRepository;
use Shop\Model\Page;

class Delete extends AbstractController
{
    private PageRepository $pageRepository;

    public function __construct(
        \Shop\Model\AdminLogin $adminLogin,
        PageRepository  $pageRepository
    ){
        parent::__construct($adminLogin);
        $this->pageRepository=$pageRepository;
    }


    public function execute(\Klein\Request $request, \Klein\Response $response)
    {
        try {
            $this->pageRepository->deleteById($request->param('id'));
        } catch (NotFoundPage $e) {
            return $response->redirect('/admin/dashboard')->send();
        }
        return $response->redirect('/admin/dashboard')->send();
    }
}