<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace AHT\Blog\Model\ResourceModel\CategoryBlog;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'categoryblog_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \AHT\Blog\Model\CategoryBlog::class,
            \AHT\Blog\Model\ResourceModel\CategoryBlog::class
        );
    }
}

