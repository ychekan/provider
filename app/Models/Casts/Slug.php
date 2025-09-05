<?php
declare(strict_types=1);

namespace App\Models\Casts;

use Illuminate\Support\Str;

trait Slug
{
    public function setNameAttribute(string $value): void
    {
        $this->attributes['name'] = $value;

        if (empty($this->attributes['slug'])) {
            $this->attributes['slug'] = Str::slug($value);
        }

        $slug = $this->attributes['slug'];
        $counter = 1;
        while (static::where('slug', $slug)->exists()) {
            $slug = $this->attributes['slug'] . '-' . ++$counter;
        }

        $this->attributes['slug'] = $slug;
    }
}
