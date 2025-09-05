<?php
declare(strict_types=1);

namespace App\Services\Provider;

use App\Helpers\CacheHelper;
use App\Repository\CategoryRepository;
use App\Repository\ServiceProviderRepository;
use App\Services\AppService;
use Illuminate\Support\Facades\Cache;

class IndexService extends AppService
{
    private array $filters;

    public function __construct(
        private readonly ServiceProviderRepository $providerRepository,
        private readonly CategoryRepository        $categoryRepository,
    )
    {
    }

    public function process(): array
    {
        $category = array_key_exists('category', $this->filters) ? $this->filters['category'] : null;
        $search = array_key_exists('search', $this->filters) ? $this->filters['search'] : null;

        $cacheKey = CacheHelper::makeListKey($category . '_' . $search . '_' . request('page', 1));

        $providers = Cache::remember($cacheKey, CacheHelper::DEFAULT_CACHE_TTL, function () {
            return $this->providerRepository->getPagination($this->filters, ['categories:id,name,slug'])
                ->withQueryString();
        });

        $categories = Cache::remember(
            CacheHelper::makeListKey('categories'),
            CacheHelper::LARGE_CACHE_TTL,
            fn() => $this->categoryRepository->getAll()->get('*')
        );

        return [$providers, $categories, $category, $search];
    }


    public function setRequest(array $filters): self
    {
        $this->filters = $filters;

        return $this;
    }
}
