<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Special\Controller\Adminhtml\Article;

use Magento\Framework\Controller\ResultFactory;

class Edit extends \Magento\Backend\App\Action 
{
    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute() {
       $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
       $resultPage->getConfig()->getTitle()->prepend(__('Edit Article'));
       return $resultPage;
    }
}