<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Special\Controller\Adminhtml\Article;

class Delete extends \Magento\Backend\App\Action 
{
    /**
     * @var \AlbertMage\Special\Model\Article
     */
    protected $article;

    /**
     * @param Context $context
     * @param \AlbertMage\Special\Model\Article $article
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \AlbertMage\Special\Model\Article $article
    ) {
        parent::__construct($context);
        $this->article = $article;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('AlbertMage_SpecialArticle::index_delete');
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $article_id = $this->getRequest()->getParam('article_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($article_id) {
            try {
                $model = $this->article;
                $model->load($article_id);
                $model->delete();
                $this->messageManager->addSuccess(__('Article deleted successfully.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['article_id' => $article_id]);
            }
        }
        $this->messageManager->addError(__('Article does not exist.'));
        return $resultRedirect->setPath('*/*/');
    }
}