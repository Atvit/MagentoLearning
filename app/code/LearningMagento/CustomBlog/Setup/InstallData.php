<?php

namespace LearningMagento\CustomBlog\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    /**
     * {@inheritdoc}
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $setup->getConnection()->insert(
            $setup->getTable('custom_blog_post'),
            [
                'title' => 'Post 1 Title',
                'content' => 'Content of the first post.',
            ]
        );

        $setup->getConnection()->insert(
            $setup->getTable('custom_blog_post'),
            [
                'title' => 'Post 2 Title',
                'content' => 'Content of the second post.',
            ]
        );

        $setup->endSetup();
    }
}
