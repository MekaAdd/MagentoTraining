<?php
namespace AHT\Blog\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use AHT\Blog\Model\CategoryFactory;

class CategoryParent extends Column
{
    protected $categoryFactory;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        CategoryFactory $categoryFactory,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->categoryFactory = $categoryFactory;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = 'parent_id';
            foreach ($dataSource['data']['items'] as & $item) {
                if ($item[$fieldName] != '') {
                    $categoryName = $this->getCategory($item[$fieldName]);
                    $item['parent_name'] = $categoryName;
                }
            }
        }

        return $dataSource;
    }

    /**
     * @param $id
     * @return string
     */
    private function getCategory($id)
    {
        $c = $this->categoryFactory->create()->load($id);
        $c = $c->getName();
        return $c;
    }
}