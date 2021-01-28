<?php

namespace Koen\AcademyBlogFrontend\viewModel;

use Koen\AcademyBlogCore\Api\Data\PostInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Post implements ArgumentInterface
{
    public function __construct(\Koen\AcademyBlogCore\Model\Blog\Post $post) {}

    public function getPost(): PostInterface
    {

    }
}
