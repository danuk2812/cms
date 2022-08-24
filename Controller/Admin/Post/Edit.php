<?php

namespace Shop\Controller\Admin\Post;

use Shop\Controller\Admin\AbstractController;
use Shop\Exceptions\NotFoundPost;
use Shop\Model\PostRepository;
use Shop\Model\CategoryRepository;


class Edit extends AbstractController
{
    private PostRepository $postRepository;
    private CategoryRepository $categoryRepository;

    public function __construct(
        \Shop\Model\AdminLogin $adminLogin,
        PostRepository $postRepository,
        CategoryRepository $categoryRepository
    ) {
        parent::__construct($adminLogin);
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function execute(\Klein\Request $request, \Klein\Response $response)
    {
        try {
            $post = $this->postRepository->getById($request->param('id'));
            $img = $post->getData()['picture'];
            $img= (addslashes(base64_encode($img)));
        } catch (NotFoundPost $e) {
            return $response->redirect('/admin/dashboard')->send();
        }
        parent::execute($request, $response);
        $categoryData = $this->categoryRepository->getCollection()->getItemsData();

        return $this->render('adminhtml/editPost.html.twig', ['categories' => $categoryData,'post' => $post->getData(),'img'=> $img]);
    }
}