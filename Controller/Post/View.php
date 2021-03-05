<?php

namespace Koen\AcademyBlogFrontend\Controller\Post;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

class View extends Action implements HttpGetActionInterface
{
    private $pageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        PageFactory $pageFactory
    ) {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
    }

    public function execute(): ResultInterface
    {
        return $this->pageFactory->create();
    }
}
