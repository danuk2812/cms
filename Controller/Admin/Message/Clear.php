<?php

namespace Shop\Controller\Admin\Message;

use Shop\Controller\Admin\AbstractController;
use Shop\Exceptions\NotFoundAdmin;
use Shop\Exceptions\NotFoundNewAdmin;
use Shop\Model\NewAdminRepository;

class Clear extends AbstractController
{
    private NewAdminRepository $newAdminRepository;

    public function __construct(
        \Shop\Model\AdminLogin $adminLogin,
        NewAdminRepository  $newAdminRepository
    ){
        parent::__construct($adminLogin);
        $this->newAdminRepository=$newAdminRepository;
    }


    public function execute(\Klein\Request $request, \Klein\Response $response)
    {
//        var_dump("hello");
//        die();
        try {
            $this->newAdminRepository->deleteById($request->param('id'));
        } catch (NotFoundAdmin $e) {
            return $response->redirect('/admin/dashboard')->send();
        }
        return $response->redirect('/admin/dashboard')->send();
    }
}