<?php
declare(strict_types=1);

namespace App\Services\Provider;

use App\Helpers\CacheHelper;
use App\Models\ServiceProvider;
use App\Repository\ServiceProviderRepository;
use App\Services\AppService;
use Illuminate\Support\Facades\Cache;

class ShowService extends AppService
{
    private string $slug;

    public function __construct(
        private readonly ServiceProviderRepository $providerRepository,
    )
    {
    }

    public function process(): ServiceProvider
    {
        $cacheKey = CacheHelper::makeListKey($this->slug);

        return Cache::remember(
            $cacheKey,
            CacheHelper::LARGE_CACHE_TTL,
            fn () => $this->providerRepository->getBy('slug', $this->slug, ['categories:id,name,slug'])
        );
    }


    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
