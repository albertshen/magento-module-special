<?php
/**
 * Article entity resource model
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Special\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use AlbertMage\Special\Api\Data\ArticleInterface;
use AlbertMage\Special\Api\Data\ArticleInterfaceFactory;
use AlbertMage\Special\Api\Data\ArticleSearchResultsInterfaceFactory;
use AlbertMage\Special\Model\ResourceModel\Article;
use AlbertMage\Special\Model\ResourceModel\Article\CollectionFactory;

/**
 * Article repository.
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class ArticleRepository implements \AlbertMage\Special\Api\ArticleRepositoryInterface
{

    /**
     * @var \AlbertMage\Special\Model\ArticleFactory
     */
    protected $articleFactory;

    /**
     * @var \AlbertMage\Special\Model\ResourceModel\Article
     */
    protected $articleResourceModel;

    /**
     * @var \AlbertMage\Special\Api\Data\ArticleSearchResultsInterfaceFactory
     */
    protected $articleSearchResultsFactory;

    /**
     * @var \AlbertMage\Special\Model\ResourceModel\Article\CollectionFactory
     */
    protected $articleCollectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @param \AlbertMage\Special\Model\ArticleFactory $articleFactory
     * @param \AlbertMage\Special\Model\ResourceModel\Article $articleResourceModel
     * @param \AlbertMage\Special\Api\Data\ArticleSearchResultsInterfaceFactory $articleSearchResultsFactory
     * @param \AlbertMage\Special\Model\ResourceModel\Article\CollectionFactory $articleCollectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        \AlbertMage\Special\Model\ArticleFactory $articleFactory,
        \AlbertMage\Special\Model\ResourceModel\Article $articleResourceModel,
        \AlbertMage\Special\Api\Data\ArticleSearchResultsInterfaceFactory $articleSearchResultsFactory,
        \AlbertMage\Special\Model\ResourceModel\Article\CollectionFactory $articleCollectionFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->articleFactory = $articleFactory;
        $this->articleResourceModel = $articleResourceModel;
        $this->articleSearchResultsFactory = $articleSearchResultsFactory;
        $this->articleCollectionFactory = $articleCollectionFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(\AlbertMage\Special\Api\Data\ArticleInterface $article)
    {
        $this->articleResourceModel->save($article);
        return $article;
    }

    /**
     * @inheritDoc
     */
    public function delete(\AlbertMage\Special\Api\Data\ArticleInterface $article)
    {
        $this->articleResourceModel->delete($article);
        return $article;
    }

    /**
     * @inheritDoc
     */
    public function getById($id)
    {
        $article = $this->articleInterfaceFactory->create()->load($id, 'id');
        if (!$article->getId()) {
            throw new NoSuchEntityException(
                __("The article that was requested doesn't exist.")
            );
        }
        return $article;
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->articleCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $items = $collection->getItems();

        /** @var \AlbertMage\Special\Api\Data\ArticleSearchResultsInterface $searchResults */
        $searchResults = $this->articleSearchResultsFactory->create();
        $searchResults->setItems($items);
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }
}
