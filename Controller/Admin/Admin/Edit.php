<?php

namespace Shop\Controller\Admin\Admin;

use Shop\Controller\Admin\AbstractController;
use Shop\Exceptions\NotFoundAdmin;
use Shop\Exceptions\NotFoundNewAdmin;
use Shop\Model\AdminRepository;
use Shop\Model\NewAdminRepository;


class Edit extends AbstractController
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
        $newAdminRepository = $this->newAdminRepository->getCollection()->getItemsData();
        foreach ($newAdminRepository as $key => $value) {
            $adminNewArr [$value['id']] = $value["message"];
        }
        try {
            $admin = $this->adminRepository->getById($request->param('id'));
            $admin=$admin->getData();
            if (isset($adminNewArr[$admin["id"]])) {
                $newAdmin = $this->newAdminRepository->getById($admin['id']);
                $admin["message"]=$adminNewArr[$admin["id"]];
            }
        } catch (NotFoundAdmin $e) {
            return $response->redirect('/admin/dashboard')->send();
        }

        return $this->render('adminhtml/editAdmin.html.twig', ['user' => $admin]);
    }
}