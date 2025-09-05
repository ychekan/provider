<?php
declare(strict_types=1);

namespace App\Http\Requests\Provider;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'category' => 'sometimes|string|nullable|exists:categories,slug',
            'page' => 'sometimes|integer|min:1',
            'search' => 'sometimes|string|nullable|max:20',
        ];
    }
}
