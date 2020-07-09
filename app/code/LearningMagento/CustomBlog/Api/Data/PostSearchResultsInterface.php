<?php

namespace LearningMagento\CustomBlog\Api\Data;

interface PostSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get box list
     *
     * @return \LearningMagento\CustomBlog\Api\Data\PostInterface[]
     */
    public function getItems();

    /**
     * Set box list
     *
     * @api
     * @param \LearningMagento\CustomBlog\Api\Data\PostInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
