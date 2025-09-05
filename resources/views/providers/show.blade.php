@extends('layouts.app')

@section('content')
    <div class="container">

        <a href="{{ route('providers.index') }}" class="btn btn-link mb-3">&larr; Back to list</a>

        <div class="card">
            <div class="row g-0">
                <div class="col-md-4 d-flex align-items-center justify-content-center bg-light">
                    @if($provider->logo)
                        <img src="{{ asset('storage/' . $provider->logo->path) }}"
                             alt="{{ $provider->name }} logo"
                             class="img-fluid p-3"
                             style="max-height: 250px; object-fit: contain;">
                    @else
                        <span class="text-muted">No Logo</span>
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h2 class="card-title">{{ $provider->name }}</h2>

                        <p class="card-text">{{ $provider->short_description }}</p>

                        <div class="mb-3">
                            @foreach($provider->categories as $category)
                                <span class="badge bg-info text-dark">{{ $category->name }}</span>
                            @endforeach
                        </div>

                        <p class="text-muted">
                            Added on {{ $provider->created_at?->format('M d, Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
