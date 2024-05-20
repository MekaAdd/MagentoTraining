<?php
namespace MyModule\HelloWorld\Block;

use Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use MyModule\HelloWorld\Model\ResourceModel\Post\Collection;
use MyModule\HelloWorld\Model\ResourceModel\Post\CollectionFactory;

class Index extends Template
{
    private $collectionFactory;
	public function __construct(Context $context, CollectionFactory $collectionFactory)
	{
        $this->collectionFactory = $collectionFactory;
		parent::__construct($context);
	}

	public function sayHello(): string
	{
		return __('Hello World');
	}

	public function getPostCollection(): Collection{
		return $this->collectionFactory->create();
	}
    
    protected function _isAllowed()
    {
     return $this->_authorization->isAllowed('Magento_Customer::manage');
    }
    
}