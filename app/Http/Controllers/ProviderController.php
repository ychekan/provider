<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Provider\IndexRequest;
use App\Services\Provider\IndexService;
use App\Services\Provider\ShowService;
use Illuminate\Http\Response;

class ProviderController extends Controller
{
    public function index(IndexRequest $request, IndexService $indexService): Response
    {
        [$providers, $categories, $activeCategory, $search] = $indexService->setRequest($request->validated())->process();

        return response()->view('providers.index', compact('providers', 'categories', 'activeCategory', 'search'));
    }

    public function show(string $slug, ShowService $service): Response
    {
        $provider = $service->setSlug($slug)->process();

        return response()->view('providers.show', compact('provider'));
    }
}
