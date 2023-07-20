<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Special\Api;

/**
 * Interface for ArticleManagement.
 * @api
 * @author Albert Shen <albertshen1206@gmail.com>
 */
interface ArticleManagementInterface
{
    /**
     * Get special articles.
     *
     * @param int $page
     * @param int $pageSize
     * @return \AlbertMage\Special\Api\Data\ArticleSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getArticleList($page = 1, $pageSize = 20);

}