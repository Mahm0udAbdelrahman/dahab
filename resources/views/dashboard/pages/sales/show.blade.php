@extends('dashboard.layouts.app')
@section('title', __('Sale Details'))

@section('content')
<div class="pc-container">
    <div class="pc-content">

        <!-- Page Header -->
        <div class="page-header">
            <div class="page-block">
                <div class="page-header-title">
                    <h5 class="mb-0">{{ __('Sale Details') }}</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('Admin.home') }}">{{ __('Home') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('Admin.sales.index') }}">{{ __('Sales') }}</a>
                    </li>
                    <li class="breadcrumb-item active">{{ __('Details') }}</li>
                </ul>
            </div>
        </div>

        <!-- Content -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <h5>{{ __('Sale Information') }}</h5>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <strong>{{ __('Seller Name') }}:</strong>
                                <p>{{ $sale->user->name ?? '-' }}</p>
                            </div>
                             <div class="col-md-6 mb-3">
                                <strong>{{ __('Seller Phone') }}:</strong>
                                <p>{{ $sale->user->phone ?? '-' }}</p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>{{ __('Sale Name') }}:</strong>
                                <p>{{ $sale->name }}</p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>{{ __('Description') }}:</strong>
                                <p>{{ $sale->description }}</p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>{{ __('Price') }}:</strong>
                                <p>{{ $sale->price }}</p>
                            </div>

                           <div class="col-md-6 mb-3">
                                <strong>{{ __(key: 'Image') }}:</strong>
                              <img src="{{ $sale->image }}" class="img-fluid rounded mb-2 w-50">
                            </div>

                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <a href="{{ route('Admin.sales.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> {{ __('Back') }}
                        </a>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
