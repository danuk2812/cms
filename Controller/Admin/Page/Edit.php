<?php

namespace Shop\Controller\Admin\Page;

use Shop\Controller\Admin\AbstractController;
use Shop\Exceptions\NotFoundPage;
use Shop\Model\PageRepository;


class Edit extends AbstractController
{
    private PageRepository $pageRepository;

    public function __construct(
        \Shop\Model\AdminLogin $adminLogin,
        PageRepository $pageRepository
    ) {
        parent::__construct($adminLogin);
        $this->pageRepository = $pageRepository;
    }

    public function execute(\Klein\Request $request, \Klein\Response $response)
    {
        try {
            $pages = $this->pageRepository->getById($request->param('id'));
        } catch (NotFoundPage $e) {
            return $response->redirect('/admin/dashboard')->send();
        }

        return $this->render('adminhtml/editPage.html.twig', ['page' => $pages->getData()]);
    }
}