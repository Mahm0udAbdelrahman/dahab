@extends('dashboard.layouts.app')
@section('title', __('Add Product'))

@section('content')
    <div class="pc-container">
        <div class="pc-content">

            <!-- Page Header -->
            <div class="page-header">
                <div class="page-block">
                    <div class="page-header-title">
                        <h5 class="mb-0 font-medium">{{ __('Add Product') }}</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Admin.home') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('Admin.products.index') }}">{{ __('Product') }}</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">{{ __('Add Product') }}</li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="row mb-5">
                <div class="col-12">
                    <form method="post" action="{{ route('Admin.products.store') }}" enctype="multipart/form-data"
                        class="p-3 rounded shadow-lg bg-white">
                        @csrf
                        <div class="card border-0">
                            <div class="card-header bg-primary text-white rounded-top">
                                <h5 class="mb-0">{{ __('Add Product') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">

                                    @php
                                        $langs = [
                                            'ar' => 'Arabic',
                                            'en' => 'English',
                                        ];
                                    @endphp


                                    <ul class="nav nav-tabs mb-4" role="tablist">
                                        @foreach ($langs as $key => $lang)
                                            <li class="nav-item">
                                                <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                                    data-bs-toggle="tab" data-bs-target="#lang-{{ $key }}"
                                                    type="button">
                                                    {{ $lang }}
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <div class="tab-content">
                                        @foreach ($langs as $key => $lang)
                                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                                id="lang-{{ $key }}">
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Name
                                                            ({{ $lang }})
                                                        </label>
                                                        <input type="text" name="name[{{ $key }}]"
                                                            value="{{ old("name.$key") }}" class="form-control">
                                                        @error("name.$key")
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Description
                                                            ({{ $lang }})</label>
                                                        <input type="text" name="description[{{ $key }}]"
                                                            value="{{ old("description.$key") }}" class="form-control">
                                                        @error("description.$key")
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>



                                    <div class="col-md-6">
                                        <label for="category_id" class="form-label">{{ __('Category') }}</label>

                                        <select class="form-select" name="category_id" id="category_id">
                                            <option value="" disabled selected>
                                                {{ __('Choose category...') }}
                                            </option>

                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name[app()->getLocale()] }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('category_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>


                                    <div class="col-md-6">
                                        <label for="price" class="form-label">{{ __('Price') }}</label>
                                        <input type="number" name="price" id="price" value="{{ old('price') }}"
                                            class="form-control" placeholder="{{ __('Enter the product price') }}">
                                        @error('price')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="discounted_price"
                                            class="form-label">{{ __('Discounted Price') }}</label>
                                        <input type="number" name="discounted_price" id="discounted_price"
                                            value="{{ old('discounted_price') }}" class="form-control"
                                            placeholder="{{ __('Enter the discounted price') }}">
                                        @error('discounted_price')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="amount_in_stock" class="form-label">{{ __('Amount In Stock') }}</label>
                                        <input type="number" name="amount_in_stock" id="amount_in_stock"
                                            value="{{ old('amount_in_stock') }}" class="form-control"
                                            placeholder="{{ __('Enter the amount in stock') }}">
                                        @error('amount_in_stock')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="status" class="form-label">{{ __('Status') }}</label>
                                        <select name="status" id="status" class="form-select">
                                            <option value="" {{ old('status') === null ? 'selected' : '' }}>
                                                {{ __('Choose status...') }}</option>
                                            <option value="used" {{ old('status') === 'used' ? 'selected' : '' }}>
                                                {{ __('Used') }}</option>
                                            <option value="new" {{ old('status') === 'new' ? 'selected' : '' }}>
                                                {{ __('New') }}</option>
                                        </select>
                                        @error('status')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="is_active" class="form-label">{{ __('Is Active') }}</label>
                                        <select class="form-select" name="is_active" id="is_active">
                                            <option value="" {{ old('is_active') === null ? 'selected' : '' }}>
                                                {{ __('Choose is_active...') }}</option>
                                            <option value="0" {{ old('is_active') === '0' ? 'selected' : '' }}>
                                                {{ __('UnActive') }}</option>
                                            <option value="1" {{ old('is_active') === '1' ? 'selected' : '' }}>
                                                {{ __('Active') }}</option>
                                        </select>
                                        @error('is_active')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="images" class="form-label">{{ __('Product Images') }}</label>
                                        <input type="file" name="images[]" id="images" multiple
                                            class="form-control">
                                        @error('images')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>


                                </div>
                            </div>
                            <div class="card-footer text-end bg-light rounded-bottom">
                                <button type="submit" class="btn btn-primary px-4">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
