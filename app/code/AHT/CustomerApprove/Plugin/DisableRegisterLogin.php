<?php

namespace AHT\CustomerApprove\Plugin;

use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\App\Response\RedirectInterface;
use Magento\Customer\Model\Session;
use Magento\Customer\Controller\Account\CreatePost;

class DisableRegisterLogin
{
    protected $resultRedirectFactory;

    protected $redirect;

    protected $customerSession;

    public function __construct(
        RedirectFactory $redirectFactory,
        RedirectInterface $redirectInterface,
        Session $customerSession
    ) {
        $this->resultRedirectFactory = $redirectFactory;
        $this->redirect = $redirectInterface;
        $this->customerSession = $customerSession;
    }

    public function afterExecute(CreatePost $subject, $result)
    {
        if ($this->customerSession->isLoggedIn()){
            $lastCustomerId = $this->customerSession->getCustomerId();
            $this->customerSession->logout()->setBeforeAuthUrl($this->redirect->getRefererUrl())
                ->setLastCustomerId($lastCustomerId);

            /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath('customer/account/login');
            $result = $resultRedirect;
        }
        return $result;
    }
}