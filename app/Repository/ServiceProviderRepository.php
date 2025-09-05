<?php
declare(strict_types=1);

namespace App\Repository;

use App\Models\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class ServiceProviderRepository extends AppRepository
{
    private static int $prePage = 20;

    private static array $selectFields = ['id', 'name', 'slug', 'short_description', 'logo_path', 'updated_at'];

    public function getAll(array $filters = [], array $relations = []): Builder
    {
        return ServiceProvider::query()
            ->with($relations)
            ->byCategory($filters['category'] ?? null)
            ->search($filters['search'] ?? null)
            ->orderBy('name')
            ->select(self::$selectFields);
    }

    public function getBy(string $column, int|string $value, ?array $relations = []): ServiceProvider|Model|null
    {
        return ServiceProvider::with($relations)->where($column, $value)->firstOrFail(self::$selectFields);
    }

    public function create(array $values)
    {
        return ServiceProvider::create($values);
    }

    public function syncCategory(ServiceProvider $provider, int $categoryId): void
    {
        $provider->category()->sync([$categoryId]);
    }

    public function edit(ServiceProvider $provider, array $values): bool
    {
        return $provider->update($values);
    }

    public function getPagination(array $filters = [], array $relations = []): LengthAwarePaginator
    {
        return $this->getAll($filters, $relations)->paginate(
            self::$prePage,
            self::$selectFields,
            'page',
            $filters['page'] ?? 1
        );
    }
}
