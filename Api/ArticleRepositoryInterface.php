<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Special\Api;

/**
 * Article CRUD interface.
 * @author Albert Shen <albertshen1206@gmail.com>
 */
interface ArticleRepositoryInterface
{
    /**
     * Save article.
     *
     * @param \AlbertMage\Special\Api\Data\ArticleInterface $article
     * @return \AlbertMage\Special\Api\Data\ArticleInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\AlbertMage\Special\Api\Data\ArticleInterface $article);

    /**
     * Delete article.
     *
     * @param \AlbertMage\Special\Api\Data\ArticleInterface $article
     * @return \AlbertMage\Special\Api\Data\ArticleInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\AlbertMage\Special\Api\Data\ArticleInterface $article);

    /**
     * Retrieve article.
     *
     * @param int $articleId
     * @return \AlbertMage\Special\Api\Data\ArticleInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($articleId);

    /**
     * Retrieve article matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \AlbertMage\Special\Api\Data\ArticleSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}
