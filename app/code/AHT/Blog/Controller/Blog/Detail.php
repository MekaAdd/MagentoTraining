<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace AHT\Blog\Controller\Blog;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Detail implements HttpGetActionInterface
{
    protected $resultPageFactory;

    public function __construct(
        PageFactory $resultPageFactory) 
    {
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        
        $resultPage->getConfig()->getTitle()->set(__('Blog'));
        return $resultPage;
    }
}

