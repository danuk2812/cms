<?php

namespace Shop\Controller\Admin\Page;

use Shop\Controller\Admin\AbstractController;

class AddAction extends AbstractController
{
    public function execute(\Klein\Request $request, \Klein\Response $response)
    {
        parent::execute($request, $response);
        return $this->render('adminhtml/newPage.html.twig');
    }
}