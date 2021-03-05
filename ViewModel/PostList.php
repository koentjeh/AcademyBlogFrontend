<?php

namespace Koen\AcademyBlogFrontend\ViewModel;

use Koen\AcademyBlogCore\Api\Data\PostInterface;
use Koen\AcademyBlogCore\Api\PostRepositoryInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class PostList implements ArgumentInterface
{
    /** @var PostRepositoryInterface */
    private $postRepository;

    /**
     * LatestPosts constructor.
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(
        PostRepositoryInterface $postRepository
    ) {
        $this->postRepository = $postRepository;
    }

    /**
     * @param int $limit
     * @param int $page
     * @return PostInterface[]
     */
    public function getPosts(int $limit = 4, int $page = 1): array
    {
        $searchCriteriaBuilder = $this->postRepository->getSearchCriteriaBuilder();
        $searchCriteriaBuilder->setCurrentPage(1);
        $searchCriteriaBuilder->setPageSize($limit);
        $searchCriteria = $searchCriteriaBuilder->create();

        return $this->postRepository->getList($searchCriteria)->getItems();
    }
}
