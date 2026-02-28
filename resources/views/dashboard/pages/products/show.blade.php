@extends('dashboard.layouts.app')
@section('title', __('Product Details'))

@section('content')

    <div class="pc-container">
        <div class="pc-content">


            <!-- Page Header -->
            <div class="page-header">
                <div class="page-block">
                    <div class="page-header-title">
                        <h5 class="mb-0">{{ __('Product Details') }}</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Admin.home') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('Admin.products.index') }}">{{ __('Products') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ __('Show Product') }}</li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">

                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">{{ $product->name[app()->getLocale()] }}</h5>
                            <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-danger' }}">
                                {{ $product->is_active ? __('Active') : __('UnActive') }}
                            </span>
                        </div>

                        <div class="card-body">

                            <!-- Images -->
                            <div class="mb-4">
                                <h6 class="mb-3">{{ __('Product Images') }}</h6>
                                <div class="row g-3">
                                    @forelse($product->images as $image)
                                        <div class="col-md-3">
                                            <div class="border rounded p-2 h-100">
                                                <img src="{{ asset($image->image) }}" class="img-fluid rounded w-50"
                                                    alt="product-image">
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-muted">{{ __('No images available') }}</p>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Translations -->
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-white d-flex align-items-center">
                                    <i class="ti ti-language fs-4 me-2 text-primary"></i>
                                    <h6 class="mb-0 fw-semibold">{{ __('Translations') }}</h6>
                                </div>

                                <div class="card-body">

                                    <!-- Tabs -->
                                    <ul class="nav nav-pills mb-4 gap-2" role="tablist">
                                        @foreach (['ar' => 'Arabic', 'en' => 'English'] as $key => $lang)
                                            <li class="nav-item">
                                                <button
                                                    class="nav-link px-4 {{ app()->getLocale() == $key ? 'active' : '' }}"
                                                    data-bs-toggle="tab" data-bs-target="#show-{{ $key }}"
                                                    type="button">
                                                    <i class="ti ti-world me-1"></i> {{ $lang }}
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <!-- Content -->
                                    <div class="tab-content">
                                        @foreach (['ar', 'en'] as $locale)
                                            <div class="tab-pane fade {{ app()->getLocale() == $locale ? 'show active' : '' }}"
                                                id="show-{{ $locale }}">

                                                <div class="row g-3">

                                                    <!-- Name -->
                                                    <div class="col-12">
                                                        <div class="p-3 rounded bg-light">
                                                            <small class="text-muted fw-semibold d-block mb-1">
                                                                <i class="ti ti-tag me-1"></i> {{ __('Name') }}
                                                            </small>
                                                            <p class="mb-0 fw-medium">
                                                                {{ $product->name[$locale] ?? '-' }}
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <!-- Description -->
                                                    <div class="col-12">
                                                        <div class="p-3 rounded bg-light">
                                                            <small class="text-muted fw-semibold d-block mb-1">
                                                                <i class="ti ti-align-left me-1"></i>
                                                                {{ __('Description') }}
                                                            </small>
                                                            <p class="mb-0 text-muted">
                                                                {{ $product->description[$locale] ?? '-' }}
                                                            </p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>


                            <!-- Product Info -->
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="border rounded p-3">
                                        <small class="text-muted">{{ __('Price') }}</small>
                                        <h6 class="mb-0">{{ $product->price }}</h6>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="border rounded p-3">
                                        <small class="text-muted">{{ __('Discounted Price') }}</small>
                                        <h6 class="mb-0">{{ $product->discounted_price ?? '-' }}</h6>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="border rounded p-3">
                                        <small class="text-muted">{{ __('Amount In Stock') }}</small>
                                        <h6 class="mb-0">{{ $product->amount_in_stock }}</h6>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="border rounded p-3">
                                        <small class="text-muted">{{ __('Status') }}</small>
                                        <h6 class="mb-0 text-capitalize">{{ $product->status }}</h6>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer text-end bg-light">
                            <a href="{{ route('Admin.products.edit', $product->id) }}"
                                class="btn btn-warning">{{ __('Edit') }}</a>
                            <a href="{{ route('Admin.products.index') }}"
                                class="btn btn-secondary">{{ __('Back') }}</a>
                        </div>

                    </div>
                </div>
            </div>

        </div>


    </div>
@endsection
