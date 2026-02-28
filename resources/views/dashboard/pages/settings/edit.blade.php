@extends('dashboard.layouts.app')
@section('title', __('Edit Setting'))

@section('content')
    <div class="pc-container">
        <div class="pc-content">

            <!-- Page Header -->
            <div class="page-header">
                <div class="page-block">
                    <div class="page-header-title">
                        <h5 class="mb-0 font-medium">{{ __('Edit Setting') }}</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Admin.home') }}">{{ __('Home') }}</a></li>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">{{ __('Edit Setting') }}</li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="row mb-5">
                <div class="col-12">
                    <form method="post" action="{{ route('Admin.settings.update') }}"
                        enctype="multipart/form-data" class="p-3 rounded shadow-lg bg-white">
                        @csrf
                        @method('PUT')

                        <div class="card border-0">
                            <div class="card-header bg-primary text-white rounded-top">
                                <h5 class="mb-0">{{ __('Edit Setting') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">



                                    @php
                                        $langs = [
                                            'ar' => 'Arabic',
                                            'en' => 'English',
                                        ];
                                    @endphp

                                    <div class="card shadow-lg border-0 mb-4">


                                        <div class="card-body">
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
                                                                    value="{{ old("name.$key", data_get($setting->name ?? [], $key)) }}"
                                                                    class="form-control">
                                                                @error("name.$key")
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label class="form-label">Address
                                                                    ({{ $lang }})</label>
                                                                <input type="text" name="address[{{ $key }}]"
                                                                    value="{{ old("address.$key", data_get($setting->address ?? [], $key)) }}"
                                                                    class="form-control">
                                                                @error("address.$key")
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Phone') }}</label>
                                        <input type="text" name="phone" value="{{ old('phone', $setting->phone ?? '') }}"
                                            class="form-control">
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('Email') }}</label>
                                        <input type="text" name="email" value="{{ old('email', $setting->email ?? '') }}"
                                            class="form-control">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('logo') }}</label>
                                        <input type="file" name="logo" value="{{ old('logo', $setting->logo ?? '') }}"
                                            class="form-control">
                                        @error('logo')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('favicon') }}</label>
                                        <input type="file" name="favicon"
                                            value="{{ old('favicon', $setting->favicon ?? '') }}" class="form-control">
                                        @error('favicon')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>


                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('facebook') }}</label>
                                        <input type="text" name="facebook"
                                            value="{{ old('facebook', $setting->facebook ?? '') }}" class="form-control">
                                        @error('facebook')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>


                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('instagram') }}</label>
                                        <input type="text" name="instagram"
                                            value="{{ old('instagram', $setting->instagram ?? '') }}" class="form-control">
                                        @error('instagram')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('tiktok') }}</label>
                                        <input type="text" name="tiktok" value="{{ old('tiktok', $setting->tiktok ?? '') }}"
                                            class="form-control">
                                        @error('tiktok')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>


                                    <div class="col-md-6">
                                        <label class="form-label">{{ __('whatsapp') }}</label>
                                        <input type="text" name="whatsapp"
                                            value="{{ old('whatsapp', $setting->whatsapp ?? '') }}" class="form-control">
                                        @error('whatsapp')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>








                                </div>
                            </div>
                            <div class="card-footer text-end bg-light rounded-bottom">
                                <button type="submit" class="btn btn-primary px-4">{{ __('Update') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
