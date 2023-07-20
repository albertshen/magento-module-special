<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Special\Controller\Adminhtml\Article;

use Magento\Backend\App\Action;
use Magento\Backend\Model\Session;
use AlbertMage\Special\Model\Article;

class Save extends \Magento\Backend\App\Action
{

    /*
     * @var Article
     */
    protected $article;
    /**
     * @var Session
     */
    protected $adminsession;
    /**
     * @param Action\Context $context
     * @param Article           $article
     * @param Session        $adminsession
     */
    public function __construct(
        Action\Context $context,
        Article $article,
        Session $adminsession
    ) {
        parent::__construct($context);
        $this->article = $article;
        $this->adminsession = $adminsession;
    }
    /**
     * Save blog record action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $article_id = $this->getRequest()->getParam('article_id');
            if ($article_id) {
                $this->article->load($article_id);
            }

            if (isset($data['image_url'][0]['value'])) {
                unset($data['image_url']);
            } else {
                if (isset($data['image_url'][0]['file'])) {
                    $data['image_url'] = \AlbertMage\Special\Controller\Adminhtml\Image\Upload::UPLOAD_DIR.'/'.$data['image_url'][0]['file'];
                } 

                if (isset($data['image_url'][0]['url'])) {
                    $data['image_url'] = str_replace('/media/.renditions/', '', $data['image_url'][0]['url']);
                } 
            }
            
            $this->article->setData($data);
            
            try {
                $this->article->save();
                $this->messageManager->addSuccess(__('The data has been saved.'));
                $this->adminsession->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    if ($this->getRequest()->getParam('back') == 'add') {
                        return $resultRedirect->setPath('*/*/add');
                    } else {
                        return $resultRedirect->setPath('*/*/edit', ['article_id' => $this->article->getArticleId(), '_current' => true]);
                    }
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }
            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['article_id' => $this->getRequest()->getParam('article_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}