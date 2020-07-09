<?php

namespace LearningMagento\CustomBlog\Model;

class PostRepository implements \LearningMagento\CustomBlog\Api\PostRepositoryInterface
{
    protected $postFactory;
    protected $postResourceModel;
    protected $searchResultsFactory;
    protected $collectionProcessor;
    protected $postCollectionFactory;

    public function __construct(
        \LearningMagento\CustomBlog\Api\Data\PostInterfaceFactory $postFactory,
        \LearningMagento\CustomBlog\Model\ResourceModel\Post $postResourceModel,
        \LearningMagento\CustomBlog\Model\ResourceModel\Post\CollectionFactory $postCollectionFactory,
        \LearningMagento\CustomBlog\Api\Data\PostSearchResultsInterfaceFactory $searchResultsFactory,
        \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
    )
    {
        $this->postFactory = $postFactory;
        $this->postResourceModel = $postResourceModel;
        $this->postCollectionFactory = $postCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * Save post.
     *
     * @param \LearningMagento\CustomBlog\Api\Data\PostInterface $post
     * @return \LearningMagento\CustomBlog\Api\Data\PostInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\LearningMagento\CustomBlog\Api\Data\PostInterface $post)
    {
        try {
            $this->postResourceModel->save($post);
        } catch (\Exception $e) {
            throw new \Magento\Framework\Exception\CouldNotSaveException(__($e->getMessage()));
        }
        return $post;
    }

    /**
     * Retrieve post.
     *
     * @param int $postId
     * @return \LearningMagento\CustomBlog\Api\Data\PostInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($postId)
    {
        $post = $this->postFactory->create();
        $this->postResourceModel->load($post, $postId);
        if (!$post->getId()) {
            throw new \Magento\Framework\Exception\NoSuchEntityException(__('Post with id "%1" does not exist.', $postId));
        }
        return $post;
    }

    /**
     * Retrieve postes matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magento\Framework\Api\SearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->postCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * Delete post.
     *
     * @param \LearningMagento\CustomBlog\Api\Data\PostInterface $post
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\LearningMagento\CustomBlog\Api\Data\PostInterface $post)
    {
        try {
            $this->postResourceModel->delete($post);
        } catch (\Exception $e) {
            throw new \Magento\Framework\Exception\CouldNotDeleteException(__($e->getMessage()));
        }
        return true;
    }

    /**
     * Delete post by ID.
     *
     * @param int $postId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($postId)
    {
        return $this->delete($this->getById($postId));
    }
}
