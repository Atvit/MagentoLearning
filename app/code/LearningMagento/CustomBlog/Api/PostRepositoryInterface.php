<?php

namespace LearningMagento\CustomBlog\Api;

interface PostRepositoryInterface
{
    /**
     * Save post.
     *
     * @param \LearningMagento\CustomBlog\Api\Data\PostInterface $post
     * @return \LearningMagento\CustomBlog\Api\Data\PostInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\LearningMagento\CustomBlog\Api\Data\PostInterface $post);

    /**
     * Retrieve post.
     *
     * @param int $postId
     * @return \LearningMagento\CustomBlog\Api\Data\PostInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($postId);

    /**
     * Retrieve postes matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \LearningMagento\CustomBlog\Api\Data\PostSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete post.
     *
     * @param \LearningMagento\CustomBlog\Api\Data\PostInterface $post
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\LearningMagento\CustomBlog\Api\Data\PostInterface $post);

    /**
     * Delete post by ID.
     *
     * @param int $postId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($postId);
}
