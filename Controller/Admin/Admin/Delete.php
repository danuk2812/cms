<?php

namespace Shop\Controller\Admin\Admin;

use Shop\Controller\Admin\AbstractController;
use Shop\Exceptions\NotFoundAdmin;
use Shop\Model\AdminRepository;

class Delete extends AbstractController
{
    private AdminRepository $adminRepository;

    public function __construct(
        \Shop\Model\AdminLogin $adminLogin,
        AdminRepository  $adminRepository
    ){
        parent::__construct($adminLogin);
        $this->adminRepository=$adminRepository;
    }


    public function execute(\Klein\Request $request, \Klein\Response $response)
    {
        try {
            $this->adminRepository->deleteById($request->param('id'));
        } catch (NotFoundAdmin $e) {
            return $response->redirect('/admin/dashboard')->send();
        }
        return $response->redirect('/admin/dashboard')->send();
    }
}