<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace AHT\Blog\Api\Data;

interface CategoryBlogInterface
{

    const CATEGORY_ID = 'category_id';
    const BLOG_ID = 'blog_id';
    const CATEGORYBLOG_ID = 'categoryblog_id';

    /**
     * Get categoryblog_id
     * @return string|null
     */
    public function getCategoryblogId();

    /**
     * Set categoryblog_id
     * @param string $categoryblogId
     * @return \AHT\Blog\CategoryBlog\Api\Data\CategoryBlogInterface
     */
    public function setCategoryblogId($categoryblogId);

    /**
     * Get category_id
     * @return string|null
     */
    public function getCategoryId();

    /**
     * Set category_id
     * @param string $categoryId
     * @return \AHT\Blog\CategoryBlog\Api\Data\CategoryBlogInterface
     */
    public function setCategoryId($categoryId);

    /**
     * Get blog_id
     * @return string|null
     */
    public function getBlogId();

    /**
     * Set blog_id
     * @param string $blogId
     * @return \AHT\Blog\CategoryBlog\Api\Data\CategoryBlogInterface
     */
    public function setBlogId($blogId);
}

