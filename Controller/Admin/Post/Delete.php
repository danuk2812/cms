<?php

namespace Shop\Controller\Admin\Post;

use Shop\Controller\Admin\AbstractController;
use Shop\Exceptions\NotFoundCategory;
use Shop\Model\Post;
use Shop\Model\PostRepository;

class Delete extends AbstractController
{
    private PostRepository $postRepository;

    public function __construct(
        \Shop\Model\AdminLogin $adminLogin,
        PostRepository  $postRepository
    ){
        parent::__construct($adminLogin);
        $this->postRepository=$postRepository;
    }


    public function execute(\Klein\Request $request, \Klein\Response $response)
    {
        try {
            $this->postRepository->deleteById($request->param('id'));
        } catch (NotFoundPost $e) {
            return $response->redirect('/admin/dashboard')->send();
        }
        return $response->redirect('/admin/dashboard')->send();
    }
}