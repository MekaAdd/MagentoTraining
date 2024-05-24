<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace AHT\Blog\Api\Data;

interface CategoryBlogSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get CategoryBlog list.
     * @return \AHT\Blog\Api\Data\CategoryBlogInterface[]
     */
    public function getItems();

    /**
     * Set category_id list.
     * @param \AHT\Blog\Api\Data\CategoryBlogInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

