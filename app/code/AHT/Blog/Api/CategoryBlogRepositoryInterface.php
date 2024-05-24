<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace AHT\Blog\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface CategoryBlogRepositoryInterface
{

    /**
     * Save CategoryBlog
     * @param \AHT\Blog\Api\Data\CategoryBlogInterface $categoryBlog
     * @return \AHT\Blog\Api\Data\CategoryBlogInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \AHT\Blog\Api\Data\CategoryBlogInterface $categoryBlog
    );

    /**
     * Retrieve CategoryBlog
     * @param string $categoryblogId
     * @return \AHT\Blog\Api\Data\CategoryBlogInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($categoryblogId);

    /**
     * Retrieve CategoryBlog matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \AHT\Blog\Api\Data\CategoryBlogSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete CategoryBlog
     * @param \AHT\Blog\Api\Data\CategoryBlogInterface $categoryBlog
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \AHT\Blog\Api\Data\CategoryBlogInterface $categoryBlog
    );

    /**
     * Delete CategoryBlog by ID
     * @param string $categoryblogId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($categoryblogId);
}

