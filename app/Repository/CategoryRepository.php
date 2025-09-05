<?php
declare(strict_types=1);

namespace App\Repository;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;

class CategoryRepository extends AppRepository
{
    protected static array $selectFields = ['id', 'name', 'slug'];

    public function getAll(array $filters = [], array $relations = []): Builder
    {
        return Category::query()
            ->with($relations)
            ->when(
                $filters && array_key_exists('search', $filters),
                fn (Builder $query) => $query->search($filters['search'])
            )
            ->orderBy('name')
            ->select(self::$selectFields);
    }
}
