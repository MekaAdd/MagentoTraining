<?php
namespace AHT\Blog\Block\Blog;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use AHT\Blog\Model\ResourceModel\Blog\CollectionFactory;

class Detail extends Template
{
    private $blogCollectionFactory;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime $dateHelper
     */
    protected $dateHelper;

	public function __construct(
        Context $context,
        CollectionFactory $blogCollectionFactory,
        \Magento\Framework\Stdlib\DateTime\DateTime $dateHelper,
    )
	{
        $this->blogCollectionFactory = $blogCollectionFactory;
        $this->dateHelper = $dateHelper;

		parent::__construct($context);
	}

    public function getBlog() {
        $id = $this->getRequest()->getParam('blog_id');

        if (!$id) {
            return NULL;
        }

        $collection = $this->blogCollectionFactory->create();

        $today = $this->dateHelper->gmtDate();

        $collection->getSelect()->joinLeft(
            ['u' => 'admin_user'],
            'main_table.author = u.user_id',
            ['username']
        )->where('main_table.status = ?', '1')
        ->where('main_table.publish_date <= ?', $today)
        ->where('main_table.blog_id = ?', $id);

        $model = $collection->getFirstItem();

        return $model;
    }
}