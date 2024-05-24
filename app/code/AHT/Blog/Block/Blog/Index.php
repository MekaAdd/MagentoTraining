<?php
namespace AHT\Blog\Block\Blog;

use Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;

class Index extends Template
{
    private $blogCollectionFactory;
    private $categoryCollectionFactory;
    private $categoryBlogCollectionFactory;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime $dateHelper
     */
    protected $dateHelper;

	public function __construct(
        Context $context,
        \AHT\Blog\Model\ResourceModel\Blog\CollectionFactory $blogCollectionFactory,
        \AHT\Blog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
        \AHT\Blog\Model\ResourceModel\CategoryBlog\CollectionFactory $categoryBlogCollectionFactory,
        \Magento\Framework\Stdlib\DateTime\DateTime $dateHelper,
    )
	{
        $this->blogCollectionFactory = $blogCollectionFactory;
        $this->categoryCollectionFactory = $categoryCollectionFactory;
        $this->categoryBlogCollectionFactory = $categoryBlogCollectionFactory;
        $this->dateHelper = $dateHelper;

		parent::__construct($context);
	}

    public function getCategoryList() {
        return $this->categoryCollectionFactory->create();
    }

    public function getBlogList() {
        $blogs = $this->blogCollectionFactory->create();

        return $blogs;
    }

    public function getBlogByCategories() {
        $collection = $this->categoryBlogCollectionFactory->create();

        $today = $this->dateHelper->gmtDate();

        $collection->getSelect()->joinLeft(
        ['r' => 'aht_blog_blog'],
        'main_table.blog_id = r.blog_id',
        ['*']
        )->joinLeft(
            ['u' => 'admin_user'],
            'r.author = u.user_id',
            ['username']
        )->where('r.status = ?', '1')
        ->where('r.publish_date <= ?', $today);
        
        return $collection;
    }
}