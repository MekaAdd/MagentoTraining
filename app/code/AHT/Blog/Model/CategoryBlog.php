<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace AHT\Blog\Model;

use AHT\Blog\Api\Data\CategoryBlogInterface;
use Magento\Framework\Model\AbstractModel;

class CategoryBlog extends AbstractModel implements CategoryBlogInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\AHT\Blog\Model\ResourceModel\CategoryBlog::class);
    }

    /**
     * @inheritDoc
     */
    public function getCategoryblogId()
    {
        return $this->getData(self::CATEGORYBLOG_ID);
    }

    /**
     * @inheritDoc
     */
    public function setCategoryblogId($categoryblogId)
    {
        return $this->setData(self::CATEGORYBLOG_ID, $categoryblogId);
    }

    /**
     * @inheritDoc
     */
    public function getCategoryId()
    {
        return $this->getData(self::CATEGORY_ID);
    }

    /**
     * @inheritDoc
     */
    public function setCategoryId($categoryId)
    {
        return $this->setData(self::CATEGORY_ID, $categoryId);
    }

    /**
     * @inheritDoc
     */
    public function getBlogId()
    {
        return $this->getData(self::BLOG_ID);
    }

    /**
     * @inheritDoc
     */
    public function setBlogId($blogId)
    {
        return $this->setData(self::BLOG_ID, $blogId);
    }
}

