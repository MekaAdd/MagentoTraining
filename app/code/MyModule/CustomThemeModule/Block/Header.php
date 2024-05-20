<?php
namespace MyModule\CustomThemeModule\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Header extends Template
{
	public function __construct(Context $context)
	{
		parent::__construct($context);
	}
}