<?php
 
namespace AHT\Blog\Controller\Adminhtml\Blog;
 
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use AHT\Blog\Model\ImageUploader;
 
class Upload extends \Magento\Backend\App\Action
{
    public $imageUploader;
 
    public function __construct(
        Context $context,
        ImageUploader $imageUploader
    )
    {
        parent::__construct($context);
        $this->imageUploader = $imageUploader;
    }
 
    // public function _isAllowed()
    // {
    //     return $this->_authorization->isAllowed('Vendor_Module::label');
    // }
 
    public function execute()
    {
        try {
            $result = $this->imageUploader->saveFileToTmpDir('thumbnail');
            $result['cookie'] = [
                'name' => $this->_getSession()->getName(),
                'value' => $this->_getSession()->getSessionId(),
                'lifetime' => $this->_getSession()->getCookieLifetime(),
                'path' => $this->_getSession()->getCookiePath(),
                'domain' => $this->_getSession()->getCookieDomain(),
            ];
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
    }
}