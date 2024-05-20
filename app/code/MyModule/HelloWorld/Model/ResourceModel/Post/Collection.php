<?php
namespace MyModule\HelloWorld\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
	protected $_idFieldName = 'post_id';
	protected $_eventPrefix = 'mymodule_helloworld_post_collection';
	protected $_eventObject = 'post_collection';

	protected function _construct()
	{
		$this->_init('MyModule\HelloWorld\Model\Post', 'MyModule\HelloWorld\Model\ResourceModel\Post');
	}

}
