<?php

namespace Shop\Controller\Admin\Admin;

use Shop\Controller\Admin\AbstractController;
use Shop\Model\Admin;
use Shop\Model\AdminRepository;

class Save extends AbstractController
{
    private AdminRepository  $adminRepository;

    public function __construct(
        \Shop\Model\AdminLogin $adminLogin,
        AdminRepository$adminRepository
    ) {
        parent::__construct($adminLogin);
        $this->adminRepository = $adminRepository;
    }

    public function execute(\Klein\Request $request, \Klein\Response $response)
    {
        $data = $request->paramsPost()->all();
        $admin = new Admin();
        $admin->setData($data);
        $this->adminRepository->save($admin);

        $response->redirect('/admin/dashboard')->send();
    }
}