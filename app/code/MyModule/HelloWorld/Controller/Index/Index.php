<?php
namespace MyModule\HelloWorld\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Result\PageFactory;
use MyModule\HelloWorld\Helper\Data;
use MyModule\HelloWorld\Model\ResourceModel\Post\CollectionFactory;

class Index implements HttpGetActionInterface
{
    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
      * @var RequestInterface
      */
    private $request;

    /**
      * @var Data
      */
    private $helperData;

    /**
      * @var CollectionFactory
      */
    private $collectionFactory;

    public function __construct(RequestInterface $request, PageFactory $pageFactory, Data $helperData, CollectionFactory $collectionFactory)
    {
        $this->pageFactory = $pageFactory;
        $this->request = $request;
        $this->helperData = $helperData;
        $this->collectionFactory = $collectionFactory;
    }

    public function execute()
    {		
        // echo $this->helperData->getGeneralConfig('enable');
		// echo $this->helperData->getGeneralConfig('display_text');

        return $this->pageFactory->create();
    }   
}