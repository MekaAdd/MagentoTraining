<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace AHT\Blog\Api\Data;

interface CategoryInterface
{

    const PARENT_ID = 'parent_id';
    const NAME = 'name';
    const CATEGORY_ID = 'category_id';

    /**
     * Get category_id
     * @return string|null
     */
    public function getCategoryId();

    /**
     * Set category_id
     * @param string $categoryId
     * @return \AHT\Blog\Category\Api\Data\CategoryInterface
     */
    public function setCategoryId($categoryId);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \AHT\Blog\Category\Api\Data\CategoryInterface
     */
    public function setName($name);

    /**
     * Get parent_id
     * @return string|null
     */
    public function getParentId();

    /**
     * Set parent_id
     * @param string $parentId
     * @return \AHT\Blog\Category\Api\Data\CategoryInterface
     */
    public function setParentId($parentId);
}

