@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Service Providers</h1>

        <form method="GET" action="{{ route('providers.index') }}" class="mb-4">
            <div class="row g-2">
                <div class="col-md-6">
                    <select name="category" class="form-select" onchange="this.form.submit()">
                        <option value="">-- All Categories --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->slug }}" @selected($activeCategory === $category->slug)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <input class="form-control" value="{{$search}}" name="search" oninput="this.form.submit()">
                </div>
            </div>
        </form>

        {{-- Providers --}}
        <div class="row">
            @foreach($providers as $provider)
                <div class="col-md-6 mb-3">
                    <div class="card h-100">
                        @if($provider->logo)
                            <img src="{{ asset('storage/' . $provider->logo->path) }}"
                                 alt="{{ $provider->name }} logo"
                                 class="card-img-top"
                                 style="max-height:150px; object-fit:contain;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $provider->name }}</h5>
                            <p class="card-text">{{ $provider->short_description }}</p>
                            @foreach($provider->categories as $category)
                                <span class="badge bg-info text-dark">{{ $category->name }}</span>
                            @endforeach
                            <a href="{{ route('providers.show', $provider->slug) }}"
                               class="btn btn-sm btn-outline-primary float-end">View</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $providers->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
