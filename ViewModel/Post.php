<?php

namespace Koen\AcademyBlogFrontend\ViewModel;

use Koen\AcademyBlogCore\Api\Data\PostInterface;
use Koen\AcademyBlogCore\Api\PostRepositoryInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Post implements ArgumentInterface
{
    private $postRepository;
    private $request;

    public function __construct(
        PostRepositoryInterface $postRepository,
        RequestInterface $request
    ) {
        $this->postRepository = $postRepository;
        $this->request = $request;
    }

    public function getPost(): PostInterface
    {
        $id = (int)$this->request->getParam('id');

        $post = $this->postRepository->get($id);

        die($post->getTitle());

//        return
    }
}
