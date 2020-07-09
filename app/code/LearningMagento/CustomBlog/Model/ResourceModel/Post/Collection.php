<?php
namespace LearningMagento\CustomBlog\Model\ResourceModel\Post;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Remittance File Collection Constructor
     * @return void
     */
    protected function _construct()
    {
        $this->_init('LearningMagento\CustomBlog\Model\Post', 'LearningMagento\CustomBlog\Model\ResourceModel\Post');
    }
}
