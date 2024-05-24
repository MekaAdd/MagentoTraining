<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace AHT\Blog\Model;

use AHT\Blog\Api\CategoryBlogRepositoryInterface;
use AHT\Blog\Api\Data\CategoryBlogInterface;
use AHT\Blog\Api\Data\CategoryBlogInterfaceFactory;
use AHT\Blog\Api\Data\CategoryBlogSearchResultsInterfaceFactory;
use AHT\Blog\Model\ResourceModel\CategoryBlog as ResourceCategoryBlog;
use AHT\Blog\Model\ResourceModel\CategoryBlog\CollectionFactory as CategoryBlogCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class CategoryBlogRepository implements CategoryBlogRepositoryInterface
{

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var CategoryBlog
     */
    protected $searchResultsFactory;

    /**
     * @var CategoryBlogCollectionFactory
     */
    protected $categoryBlogCollectionFactory;

    /**
     * @var ResourceCategoryBlog
     */
    protected $resource;

    /**
     * @var CategoryBlogInterfaceFactory
     */
    protected $categoryBlogFactory;


    /**
     * @param ResourceCategoryBlog $resource
     * @param CategoryBlogInterfaceFactory $categoryBlogFactory
     * @param CategoryBlogCollectionFactory $categoryBlogCollectionFactory
     * @param CategoryBlogSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceCategoryBlog $resource,
        CategoryBlogInterfaceFactory $categoryBlogFactory,
        CategoryBlogCollectionFactory $categoryBlogCollectionFactory,
        CategoryBlogSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->categoryBlogFactory = $categoryBlogFactory;
        $this->categoryBlogCollectionFactory = $categoryBlogCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(CategoryBlogInterface $categoryBlog)
    {
        try {
            $this->resource->save($categoryBlog);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the categoryBlog: %1',
                $exception->getMessage()
            ));
        }
        return $categoryBlog;
    }

    /**
     * @inheritDoc
     */
    public function get($categoryBlogId)
    {
        $categoryBlog = $this->categoryBlogFactory->create();
        $this->resource->load($categoryBlog, $categoryBlogId);
        if (!$categoryBlog->getId()) {
            throw new NoSuchEntityException(__('CategoryBlog with id "%1" does not exist.', $categoryBlogId));
        }
        return $categoryBlog;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->categoryBlogCollectionFactory->create();
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(CategoryBlogInterface $categoryBlog)
    {
        try {
            $categoryBlogModel = $this->categoryBlogFactory->create();
            $this->resource->load($categoryBlogModel, $categoryBlog->getCategoryblogId());
            $this->resource->delete($categoryBlogModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the CategoryBlog: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($categoryBlogId)
    {
        return $this->delete($this->get($categoryBlogId));
    }
}

