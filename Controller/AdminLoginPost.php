<?php

namespace Shop\Controller;

use Shop\Controller\Admin\AbstractController;

class AdminLoginPost extends HomeAbstractController
{
    public function execute(\Klein\Request $request, \Klein\Response $response)
    {
        if ($this->adminLogin->login($request->paramsPost()->get('login'), $request->paramsPost()->get('password'))) {
            // login success
            $response->redirect('admin/dashboard')->send();
        } else {
            // login fail

            return $this->render('adminhtml/login.html.twig', ['msg' => 'ви ввели неправильно логін або пароль']);

//            $response->redirect('admin')->send();

        }
    }
}