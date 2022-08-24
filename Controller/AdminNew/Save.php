<?php

namespace Shop\Controller\AdminNew;

use Shop\Controller\Admin\AbstractController;
use Shop\Model\Admin;
use Shop\Model\AdminRepository;
use Shop\Model\NewAdmin;
use Shop\Model\NewAdminRepository;


class Save extends AbstractController
{
    private AdminRepository $adminRepository;
    private NewAdminRepository $newAdminRepository;


    public function __construct(
        \Shop\Model\AdminLogin $adminLogin,
        AdminRepository        $adminRepository,
        NewAdminRepository     $newAdminRepository
    )
    {
        parent::__construct($adminLogin);
        $this->adminRepository = $adminRepository;
        $this->newAdminRepository = $newAdminRepository;
    }

    public function execute(\Klein\Request $request, \Klein\Response $response)
    {
        $data = $request->paramsPost()->all();
        $data['is_approved'] = 0;
        $msg = $data['message'];
        $admin = new Admin();
        $admin->setData($data);
        $this->adminRepository->save($admin);


        $newAdmin = new NewAdmin();
        $data = $this->adminRepository->getCollection()->getItemsData();
        $newAdmin->setData(['id' => $data[count($data) - 1]['id'],'message'=>$msg]);
        $this->newAdminRepository->save($newAdmin);

        $response->redirect('/admin/dashboard')->send();

        return $this->render('adminhtml/login.html.twig',
            [
                'msg' => 'очікуйте підствердження від адміністратора',
                'redirect' => 'true'
            ]
        );

    }
}