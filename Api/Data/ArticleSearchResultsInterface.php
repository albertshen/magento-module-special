<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Special\Api\Data;

/**
 * Interface for node search results.
 * @api
 * @author Albert Shen <albertshen1206@gmail.com>
 */
interface ArticleSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get node list.
     *
     * @return \AlbertMage\Special\Api\Data\ArticleInterface[]
     */
    public function getItems();

    /**
     * Set node list.
     *
     * @param \AlbertMage\Special\Api\Data\ArticleInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
