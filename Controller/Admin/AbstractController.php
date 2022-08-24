<?php

namespace Shop\Controller\Admin;

use Shop\Model\AdminLogin;

abstract class AbstractController extends \Shop\Controller\AbstractController
{
    public function execute(\Klein\Request $request, \Klein\Response $response)
   {
       if (!$this->adminLogin->validateAdmin()) {
           $response->redirect('/admin')->send();
       }
   }
}