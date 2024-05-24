<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace AHT\Blog\Model\ResourceModel\Category;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'category_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \AHT\Blog\Model\Category::class,
            \AHT\Blog\Model\ResourceModel\Category::class
        );
    }
}

