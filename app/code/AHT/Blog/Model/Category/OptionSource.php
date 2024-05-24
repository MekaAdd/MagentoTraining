<?php 

namespace AHT\Blog\Model\Category;

use Magento\Framework\Data\OptionSourceInterface;
use AHT\Blog\Model\ResourceModel\Category\CollectionFactory;

class OptionSource implements OptionSourceInterface
    {
        private $_collectionFactory;

        public function __construct(CollectionFactory $collectionFactory) 
        {
            $this->_collectionFactory = $collectionFactory;
        }

       /**
         * Return array of options as value-label pairs
         *
         * @return array Format: array(array("value" => "<value>", "label"=> "<label>"), ...)
         */
        public function toOptionArray()
        {
            /**
             * @var $collection \AHT\Blog\Model\ResourceModel\Category\Collection
             */
            $collection = $this->_collectionFactory->create();
            $options = [];
            foreach ($collection as $item) {
                $options[] = [
                    'label' => $item->getName(),
                    'value' => $item->getCategoryId()
                ];
            }
            return $options;
        }
    }