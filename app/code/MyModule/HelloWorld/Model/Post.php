<?php
namespace MyModule\HelloWorld\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;

class Post extends AbstractModel implements IdentityInterface
{
	const CACHE_TAG = 'mymodule_helloworld_post';

	protected $_cacheTag = 'mymodule_helloworld_post';

	protected $_eventPrefix = 'mymodule_helloworld_post';

	protected function _construct()
	{
		$this->_init('MyModule\HelloWorld\Model\ResourceModel\Post');
	}

	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
}