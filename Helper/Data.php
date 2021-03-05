<?php

namespace Koen\AcademyBlogFrontend\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    /** @var int */
    private const CONFIG_PATH_MAX_POSTS = 'maxserv_academy/maxserv_academy_blog/max_posts';

    /**
     * Get limit of maximum post to retrieve.
     * @return int
     */
    public function getPostLimit(): int
    {
        return (int) $this->scopeConfig->getValue(
            self::CONFIG_PATH_MAX_POSTS,
            ScopeInterface::SCOPE_STORES
        );
    }
}
