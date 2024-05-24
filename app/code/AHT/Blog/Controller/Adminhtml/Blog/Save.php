<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace AHT\Blog\Controller\Adminhtml\Blog;

use AHT\Blog\Model\ImageUploader;
use AHT\Blog\Model\ResourceModel\CategoryBlog\CollectionFactory;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;
    protected $session;
    protected $resource;
    protected $connection;
    protected $imageUploader;
    protected $categoryBlogCollectionFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \Magento\Backend\Model\Auth\Session $authSession,
        \Magento\Framework\App\ResourceConnection $resource,
        ImageUploader $imageUploader,
        CollectionFactory $categoryBlogCollectionFactory
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->session = $authSession;
        $this->connection = $resource->getConnection();
        $this->resource = $resource;
        $this->imageUploader = $imageUploader;
        $this->categoryBlogCollectionFactory = $categoryBlogCollectionFactory;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $data['author'] = $this->session->getUser()->getId();
            $id = $this->getRequest()->getParam('blog_id');
        
            $model = $this->_objectManager->create(\AHT\Blog\Model\Blog::class)->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Blog no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            if (isset($data['thumbnail'][0]['name']) && isset($data['thumbnail'][0]['tmp_name'])) {
                /** @var \Magenest\ImageUpload\Model\ImageUploader $this->imageUploader */
                $this->imageUploader->moveFileFromTmp($data['thumbnail'][0]['name']);

                $data['thumbnail'] = $data['thumbnail'][0]['url'];
            } elseif (isset($data['thumbnail'][0]['image']) && !isset($data['thumbnail'][0]['tmp_name'])) {
                $data['thumbnail'] = $data['thumbnail'][0]['url'];
            } else {
                $data['thumbnail'] = null;
            }
        
            $model->setData($data);

            try {
                $model->save();

                $categoryBlog = [];

                $collection = $this->categoryBlogCollectionFactory->create();
                $collection->addFieldToFilter('blog_id', ['=', $model->getBlogId()]);

                foreach ($collection as $item) {
                    $item->delete();
                }
                
                if (!is_null($data['categories'])) {
                    foreach ($data['categories'] as $key => $value) {
                        $categoryBlog[] = [
                            'category_id' => $value,
                            'blog_id' => $model->getBlogId()
                        ];
                    }
                }

                $tableName = $this->resource->getTableName('aht_blog_categoryblog');
                $this->connection->insertMultiple($tableName, $categoryBlog);

                $this->messageManager->addSuccessMessage(__('You saved the Blog.'));
                $this->dataPersistor->clear('aht_blog_blog');
                
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['blog_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Blog.'));
            }
        
            $this->dataPersistor->set('aht_blog_blog', $data);
            return $resultRedirect->setPath('*/*/edit', ['blog_id' => $this->getRequest()->getParam('blog_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}

