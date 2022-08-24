<?php

namespace Shop\Controller\Admin\Admin;

use Shop\Controller\Admin\AbstractController;
use Shop\Model\AdminRepository;
use Shop\Model\NewAdminRepository;


class Dashboard extends AbstractController
{
    private AdminRepository $adminRepository;
    private NewAdminRepository $newAdminRepository;

    public function __construct(
        \Shop\Model\AdminLogin $adminLogin,

        AdminRepository        $adminRepository,
        NewAdminRepository     $newAdminRepository
    )
    {
        parent::__construct($adminLogin,$adminRepository);
        $this->adminRepository = $adminRepository;
        $this->newAdminRepository = $newAdminRepository;
    }

    public function execute(\Klein\Request $request, \Klein\Response $response)
    {
        parent::execute($request, $response);
        $result = $this->render('adminhtml/admin.html.twig');
        $adminData = $this->adminRepository->getCollection()->getItemsData();
        $newAdminRepository = $this->newAdminRepository->getCollection()->getItemsData();
        foreach ($newAdminRepository as $key => $value) {
            $adminNewArr [$value['id']] = $value["message"];
        }
        $i = 0;
        foreach ($adminData as $item) {
            if (isset($adminNewArr[$item["id"]])) {
                $adminData[$i]["message"] = $adminNewArr[$item["id"]];;
            }
            $i = $i + 1;
        }

        $result .= $this->render('adminhtml/listing/adminView.html.twig', ['users' => $adminData]);
        return $result;
    }
}