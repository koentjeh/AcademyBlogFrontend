<?php

namespace Koen\AcademyBlogFrontend\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Index implements HttpGetActionInterface
{
    /** @var PageFactory */
    private $pageFactory;

    public function __construct(
        PageFactory $pageFactory
    ) {
        $this->pageFactory = $pageFactory;
    }

    public function execute()
    {
        $result = $this->pageFactory->create();
        $result->addDefaultHandle();

        return $result;
    }
}
