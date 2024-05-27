<?php
namespace AHT\CustomerApprove\Setup\Patch\Data;

use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Config;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class CustomerAttributePatcher implements DataPatchInterface
{
    /**
     * @var CustomerSetupFactory
     */
    private $customerSetupFactory;

    /**
     * @var ModuleDataSetupInterface
     */
    private $setup;

    /**
     * @var Config
     */
    private $eavConfig;

    /**
     * AccountPurposeCustomerAttribute constructor.
     * @param ModuleDataSetupInterface $setup
     * @param Config $eavConfig
     * @param CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $setup,
        Config $eavConfig,
        CustomerSetupFactory $customerSetupFactory
    )
    {
        $this->customerSetupFactory = $customerSetupFactory;
        $this->setup = $setup;
        $this->eavConfig = $eavConfig;
    }

    /** We'll add our customer attribute here */
    public function apply()
    {
        $customerSetup = $this->customerSetupFactory->create(['setup' => $this->setup]);
        $customerEntity = $customerSetup->getEavConfig()->getEntityType(Customer::ENTITY);
        $attributeSetId = $customerSetup->getDefaultAttributeSetId($customerEntity->getEntityTypeId());
        $attributeGroup = $customerSetup->getDefaultAttributeGroupId($customerEntity->getEntityTypeId(), $attributeSetId);
        $customerSetup->addAttribute(Customer::ENTITY, 'approved', [
            'type' => 'int',
            'input' => 'boolean',
            'label' => 'Approved',
            'required' => true,
            'default' => 0,
            'visible' => true,
            'user_defined' => false,
            'system' => false,
            'is_visible_in_grid' => false,
            'is_used_in_grid' => false,
            'is_filterable_in_grid' => false,
            'is_searchable_in_grid' => false,
            'position' => 300
        ]);

        $newAttribute = $this->eavConfig->getAttribute(Customer::ENTITY, 'approved');
        $newAttribute->addData([
            'used_in_forms' => ['adminhtml_customer'],
            'attribute_set_id' => $attributeSetId,
            'attribute_group_id' => $attributeGroup
        ]);
        $newAttribute->save();
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }
}