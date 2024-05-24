<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace AHT\Blog\Controller\Blog;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use AHT\Blog\Model\ResourceModel\Blog\CollectionFactory;
use Magento\Framework\Stdlib\DateTime\DateTime;

class ListData implements HttpGetActionInterface
{
    /**
      * @var RequestInterface
      */
    private $request;

    private $jsonFactory;

    private $dateHelper;

    private $blogCollectionFactory;

    public function __construct(RequestInterface $request, JsonFactory $jsonFactory, DateTime $dateHelper, CollectionFactory $blogCollectionFactory)
    {
        $this->request = $request;
        $this->jsonFactory = $jsonFactory;
        $this->dateHelper = $dateHelper;
        $this->blogCollectionFactory = $blogCollectionFactory;
    }

    public function execute()
    {
        $collection = $this->blogCollectionFactory->create();

        $search = $this->request->getParam('search');
        $category = $this->request->getParam('category');
        $ipp = $this->request->getParam('ipp') ?? '5';
        $page = $this->request->getParam('page') ?? '1';

        $today = $this->dateHelper->gmtDate();

        $collection->getSelect()->joinLeft(
            ['u' => 'admin_user'],
            'main_table.author = u.user_id',
            ['username']
        )->where('main_table.status = ?', '1')
        ->where('main_table.publish_date <= ?', $today);

        if ($search) {
            $collection->getSelect()->where('main_table.title LIKE ?', '%'.$search.'%');
        }

        if ($category) {
            $collection->getSelect()->joinLeft(
                ['c' => 'aht_blog_categoryblog'],
                'main_table.blog_id = c.blog_id',
                ['category_id']
            )->where('c.category_id = ?', $category);
        }

        $totalRecords = $collection->getSize();

        $offset = ($page - 1) * $ipp;
        $collection->getSelect()->limit($ipp, $offset);

        $data = [];
        foreach ($collection as $item) {
            $blog = [
                'blog_id' => $item['blog_id'],
                'title' => $item['title'],
                'username' => $item['username'],
                'thumbnail' => $item['thumbnail'],
                'description' => $item['description'],
                'content' => $item['content']
            ];
            $data[] = $blog;
        }

        $resultJson = $this->jsonFactory->create();
        $resultJson->setData(['data' => $data, 'total_records' => $totalRecords]);
        return $resultJson;
    }
}