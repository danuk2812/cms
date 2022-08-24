<?php

namespace Shop\Controller\AdminNew;

use Shop\Controller\AbstractController;

class AddAction  extends AbstractController
{
    public function execute(\Klein\Request $request, \Klein\Response $response): string
    {
        return $this->render('adminhtml/form/account.html.twig');


    }
}