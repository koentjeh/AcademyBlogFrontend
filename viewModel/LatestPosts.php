<?php

namespace Koen\AcademyBlogFrontend\viewModel;

use Koen\AcademyBlogCore\Api\Data\PostInterface;
use Koen\AcademyBlogCore\Api\PostRepositoryInterface;
use Koen\AcademyBlogFrontend\Helper\Data;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class LatestPosts implements ArgumentInterface
{
    /** @var PostRepositoryInterface */
    private $postCollectionRepository;

    /** @var SearchCriteriaBuilder */
    private $searchCriteriaBuilder;

    /** @var Data */
    private $config;

    /**
     * LatestPosts constructor.
     * @param PostRepositoryInterface $postRepository,
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param Data $config
     */
    public function __construct(
        PostRepositoryInterface $postRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        Data $config
    ) {
        $this->postCollectionRepository = $postRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->config = $config;
    }

    /**
     * @param int $page
     * @return PostInterface[]
     */
    public function getPosts(int $page = 1): array
    {
        $limit = $this->config->getPostLimit();

        $searchCriteria = $this->searchCriteriaBuilder
            ->setPageSize($limit)
            ->setCurrentPage($page)
            ->create();

        return $this->postCollectionRepository->getList($searchCriteria);
    }
}
