@extends('dashboard.layouts.app')
@section('title', __('Maintenance Details'))

@section('content')
    <div class="pc-container">
        <div class="pc-content">

            <!-- Page Header -->
            <div class="page-header">
                <div class="page-block">
                    <div class="page-header-title">
                        <h5 class="mb-0">{{ __('Maintenance Details') }}</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('Admin.home') }}">{{ __('Home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('Admin.maintenances.index') }}">{{ __('Maintenances') }}</a>
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
                            <h5>{{ __('Maintenance Information') }}</h5>
                        </div>

                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <strong>{{ __('User Name') }}:</strong>
                                    <p>{{ $maintenance->user->name ?? '-' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <strong>{{ __('User Phone') }}:</strong>
                                    <p>{{ $maintenance->user->phone ?? '-' }}</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>{{ __('Maintenance Name') }}:</strong>
                                    <p>{{ $maintenance->title }}</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>{{ __('Description') }}:</strong>
                                    <p>{{ $maintenance->description }}</p>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <strong>{{ __(key: 'Image') }}:</strong>
                                    <img src="{{ $maintenance->image }}" class="img-fluid rounded mb-2 w-50">
                                </div>


                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <a href="{{ route('Admin.maintenances.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> {{ __('Back') }}
                            </a>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
