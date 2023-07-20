<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
declare(strict_types=1);

namespace AlbertMage\Special\Model;

use AlbertMage\Special\Api\Data\ArticleSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Service Data Object with Article search results.
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class ArticleSearchResults extends SearchResults implements ArticleSearchResultsInterface
{
}
