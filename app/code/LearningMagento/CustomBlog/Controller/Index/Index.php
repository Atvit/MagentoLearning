<?php

namespace LearningMagento\CustomBlog\Controller\Index;

use \Magento\Framework\App\Action\Action;
use \Magento\Framework\View\Result\PageFactory;
use \Magento\Framework\App\Action\Context;
use \Magento\Framework\Exception\LocalizedException;
use \Magento\Framework\Controller\Result\JsonFactory;
use \LearningMagento\CustomBlog\Model\ResourceModel\Post\Collection as PostCollection;
use \LearningMagento\CustomBlog\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;
use \LearningMagento\CustomBlog\Model\Post;

class Index extends Action
{

    /**
     * @var resultJsonFactory
     */
    protected $resultJsonFactory;

    protected $postCollectionFactory;

    public function __construct(
        Context $context,
        PostCollectionFactory $postCollectionFactory,
        JsonFactory $resultJsonFactory
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->postCollectionFactory = $postCollectionFactory;
        parent::__construct(
            $context
        );
    }

    public function execute()
    {
        $postCollection = $this->postCollectionFactory->create();
        $postCollection->addFieldToSelect('*')->setPageSize(1)->load();
        $resultJson = $this->resultJsonFactory->create();
        $resultJson->setData($postCollection->getData());
        return $resultJson;
    }

}
