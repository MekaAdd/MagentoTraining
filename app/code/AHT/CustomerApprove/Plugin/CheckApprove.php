<?php
namespace AHT\CustomerApprove\Plugin;

use Magento\Customer\Api\AccountManagementInterface;
use Magento\Customer\Model\Customer;
use Magento\Framework\Exception\LocalizedException;

class CheckApprove
{
    private $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;    
    }

    public function afterAuthenticate(AccountManagementInterface $subject, $result) 
    {
        // $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
        // $logger = new \Zend_Log();
        // $logger->addWriter($writer);
        // $logger->info('AfterAuthenticate');

        // $this->customer->load($result->getId());

        // if (!$this->customer['approved']) 
        if (!$result->getCustomAttribute('approved')->getValue()) 
        {
            throw new LocalizedException(__('This account isn\'t approved. Verify and try again.'));
        }

        return $result;
    }
}