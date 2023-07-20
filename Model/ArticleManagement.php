<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Special\Model;

use AlbertMage\Special\Api\Data\ArticleInterfaceFactory;
use AlbertMage\Special\Model\ArticleRepository;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\Api\SearchCriteriaBuilderFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * @api
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class ArticleManagement implements \AlbertMage\Special\Api\ArticleManagementInterface
{

    /**
     * @var ArticleInterfaceFactory
     */
    protected $articleInterfaceFactory;

    /**
     * @var ArticleRepository
     */
    protected $articleRepository;

    /**
     * @var SearchCriteriaBuilderFactory
     */
    protected $searchCriteriaBuilderFactory;

    /**
     * @var SortOrderBuilder
     */
    protected $sortOrderBuilder;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @param ArticleInterfaceFactory $articleInterfaceFactory
     * @param ArticleRepository $articleRepository
     * @param SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory
     * @param SortOrderBuilder $sortOrderBuilder
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ArticleInterfaceFactory $articleInterfaceFactory,
        ArticleRepository $articleRepository,
        SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory,
        SortOrderBuilder $sortOrderBuilder,
        StoreManagerInterface $storeManager
    ) {
        $this->articleInterfaceFactory = $articleInterfaceFactory;
        $this->articleRepository = $articleRepository;
        $this->searchCriteriaBuilderFactory = $searchCriteriaBuilderFactory;
        $this->sortOrderBuilder = $sortOrderBuilder;
        $this->storeManager = $storeManager;
    }

    /**
     * @inheritDoc
     */
    public function getArticleList($page = 1, $pageSize = 20)
    {
        $searchCriteriaBuilder = $this->searchCriteriaBuilderFactory->create();
        //$searchCriteriaBuilder->addFilter('article_id', [6, 7], 'in');
        $sortOrder = $this->sortOrderBuilder
            ->setField('created_at')
            ->setDirection(SortOrder::SORT_DESC)
            ->create();
        $searchCriteriaBuilder->addSortOrder($sortOrder);
        $searchCriteria = $searchCriteriaBuilder->create();
        $searchCriteria->setPageSize($pageSize);
        $searchCriteria->setCurrentPage($page);
        $results = $this->articleRepository->getList($searchCriteria);
        foreach($results->getItems() as $item) {
            $item->setImageUrl($this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA).$item->getImageUrl());
            ;
        }
        return $results;
    }

}