<?php declare(strict_types=1);

namespace Koen\AcademyBlogFrontend\Controller;

use Koen\AcademyBlogCore\Api\Data\PostInterface;
use Koen\AcademyBlogCore\Api\PostRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Action\Forward;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;
use Magento\Framework\Url;

class Router implements RouterInterface
{
    private $postRepository;
    private $searchCriteriaBuilder;
    private $actionFactory;

    /**
     * Router constructor.
     * @param PostRepositoryInterface $postRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param ActionFactory $actionFactory
     */
    public function __construct(
        PostRepositoryInterface $postRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        ActionFactory $actionFactory
    ) {
        $this->postRepository = $postRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->actionFactory = $actionFactory;
    }

    public function match(RequestInterface $request)
    {
        $identifier = trim($request->getPathInfo(), '/');

        if (!preg_match('/^blog\/([0-9a-zA-Z\-\_\.]+)/', $identifier, $match)) {
            return null;
        }

        if ($request->getModuleName() === 'blog') {
            return null;
        }

        $urlKey = $match[1];

        if (empty($urlKey)) {
            return null;
        }

        try {
            $post = $this->getPostByUrlKey($urlKey);
        } catch (\Exception $exception) {
            return null;
        }

        $request->setParam('id', $post->getId());
        $request->setModuleName('blog');
        $request->setControllerName('post');
        $request->setActionName('view');
        $request->setAlias(Url::REWRITE_REQUEST_PATH_ALIAS, $urlKey);

        return $this->actionFactory->create(Forward::class);
    }

    private function getPostByUrlKey(string $urlKey): PostInterface
    {
        $searchCriteriaBuilder = $this->postRepository->getSearchCriteriaBuilder();
        $searchCriteriaBuilder->addFilter('url_key', $urlKey);
        $searchCriteriaBuilder->setPageSize(1);

        $searchCriteria = $searchCriteriaBuilder->create();
        $searchResult = $this->postRepository->getList($searchCriteria);

        $posts = $searchResult->getItems();

        if (empty($posts)) {
            throw new \Exception('No items found');
        }

        $item = array_shift($posts);
        if (!$item instanceof PostInterface) {
            throw new \Exception('Wrong item found');
        }

        return $item;
    }
}
