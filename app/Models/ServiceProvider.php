<?php
declare(strict_types=1);

namespace App\Models;

use App\Models\Casts\Slug;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceProvider extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Slug;

    protected $fillable = ['name', 'short_description'];

    public function scopeByCategory(Builder $query, ?string $categorySlug = null): Builder
    {
        return $query->when(
            $categorySlug,
            function (Builder $query) use ($categorySlug) {
                $query->whereHas('categories', fn(Builder $q) => $q->where('slug', $categorySlug));
            }
        );
    }

    public function scopeSearch(Builder $query, ?string $search = null): Builder
    {
        return $query->when(
            $search,
            function (Builder $query) use ($search) {
                $query->whereHas('categories', fn(Builder $q) => $q->where('name', 'like', "%{$search}%"))
                    ->orWhere('name', 'like', "%{$search}%");
            }
        );
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function logo(): MorphOne
    {
        return $this->morphOne(File::class, 'attachable')
            ->where('collection', 'logo');
    }
}
