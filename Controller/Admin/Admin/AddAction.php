<?php

namespace Shop\Controller\Admin\Admin;
use Shop\Controller\Admin\AbstractController;

class AddAction extends AbstractController
{
    public function execute(\Klein\Request $request, \Klein\Response $response)
    {
        parent::execute($request, $response);
        return $this->render('adminhtml/newAdmin.html.twig');
    }
}