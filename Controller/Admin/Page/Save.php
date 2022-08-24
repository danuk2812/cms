<?php

namespace Shop\Controller\Admin\Page;

use Shop\Controller\Admin\AbstractController;
use Shop\Model\Page;
use Shop\Model\PageRepository;

class Save extends AbstractController
{
    private PageRepository  $pageRepository;

    public function __construct(
        \Shop\Model\AdminLogin $adminLogin,
        PageRepository$pageRepository
    ) {
        parent::__construct($adminLogin);
        $this->pageRepository = $pageRepository;
    }

    public function execute(\Klein\Request $request, \Klein\Response $response)
    {
        $data = $request->paramsPost()->all();
        $page = new Page();
        $page->setData($data);
        $this->pageRepository->save($page);

        $response->redirect('/admin/dashboard')->send();
    }
}