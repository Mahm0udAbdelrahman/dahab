@extends('dashboard.layouts.app')
@section('title', __('Edit Product'))

@section('content')
<div class="pc-container">
    <div class="pc-content">

        <div class="page-header mb-4">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb mb-2">
                            <li class="breadcrumb-item"><a href="{{ route('Admin.home') }}"><i class="feather icon-home"></i> {{ __('Home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('Admin.products.index') }}">{{ __('Products') }}</a></li>
                            <li class="breadcrumb-item" aria-current="page">{{ __('Edit Product') }}</li>
                        </ul>
                        <div class="page-header-title">
                            <h2 class="mb-0 text-dark fw-bold">{{ __('Edit Product') }}:
                                <span class="text-primary">{{ data_get($product->name, app()->getLocale()) }}</span>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <form method="post" action="{{ route('Admin.products.update', $product->id) }}" enctype="multipart/form-data" id="productEditForm">
                    @csrf
                    @method('PUT')

                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 text-primary"><i class="feather icon-edit-2 me-2"></i>{{ __('General Information') }}</h5>
                        </div>

                        <div class="card-body">
                            <div class="row g-4">

                                <div class="col-md-12">
                                    <label for="category_id" class="form-label fw-bold">{{ __('Category') }}</label>
                                    <select class="form-select select2" name="category_id" id="category_id">
                                        <option value="" disabled>{{ __('Choose category...') }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name[app()->getLocale()] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-12">
                                    <div class="bg-light p-3 rounded border">
                                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                            @php $langs = ['ar' => 'Arabic', 'en' => 'English']; @endphp
                                            @foreach ($langs as $key => $lang)
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                                            data-bs-toggle="pill"
                                                            data-bs-target="#lang-{{ $key }}"
                                                            type="button">
                                                        <i class="feather icon-globe me-1"></i> {{ $lang }}
                                                    </button>
                                                </li>
                                            @endforeach
                                        </ul>

                                        <div class="tab-content">
                                            @foreach ($langs as $key => $lang)
                                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="lang-{{ $key }}">
                                                    <div class="row g-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Name ({{ $lang }})</label>
                                                            <input type="text" name="name[{{ $key }}]"
                                                                   value="{{ old("name.$key", data_get($product->name, $key)) }}"
                                                                   class="form-control @error("name.$key") is-invalid @enderror">
                                                            @error("name.$key") <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Description ({{ $lang }})</label>
                                                            <textarea name="description[{{ $key }}]" rows="1"
                                                                      class="form-control @error("description.$key") is-invalid @enderror">{{ old("description.$key", data_get($product->description, $key)) }}</textarea>
                                                            @error("description.$key") <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="price" class="form-label fw-bold">{{ __('Original Price') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" step="0.01" name="price" id="price"
                                               value="{{ old('price', $product->price) }}" class="form-control">
                                    </div>
                                    @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="discounted_price" class="form-label fw-bold text-success">{{ __('Discounted Price') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" step="0.01" name="discounted_price" id="discounted_price"
                                               value="{{ old('discounted_price', $product->discounted_price) }}" class="form-control">
                                    </div>
                                    @error('discounted_price') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="amount_in_stock" class="form-label fw-bold">{{ __('Stock Qty') }}</label>
                                    <input type="number" name="amount_in_stock" id="amount_in_stock"
                                           value="{{ old('amount_in_stock', $product->amount_in_stock) }}" class="form-control">
                                    @error('amount_in_stock') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="status" class="form-label fw-bold">{{ __('Condition') }}</label>
                                    <select class="form-select" name="status" id="status">
                                        <option value="new" {{ old('status', $product->status) == 'new' ? 'selected' : '' }}>{{ __('New') }}</option>
                                        <option value="used" {{ old('status', $product->status) == 'used' ? 'selected' : '' }}>{{ __('Used') }}</option>
                                    </select>
                                </div>

                                <hr class="my-4">
                                <div class="col-12">
                                    <h5 class="mb-3 text-primary"><i class="feather icon-image me-2"></i>{{ __('Product Gallery') }}</h5>

                                    <div class="row g-3 mb-4">
                                        @foreach($product->images as $img)
                                            <div class="col-md-2 col-sm-4 position-relative" id="image-box-{{ $img->id }}">
                                                <div class="p-1 border rounded bg-white shadow-sm h-100">
                                                    <img src="{{ asset($img->image) }}" class="img-fluid rounded w-100" style="height: 120px; object-fit: cover;">
                                                    <button type="button"
                                                            class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2 delete-image"
                                                            data-id="{{ $img->id }}">
                                                        <i class="feather icon-trash-2"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="upload-area p-4 border-dashed rounded text-center bg-light">
                                        <i class="feather icon-upload-cloud display-4 text-muted mb-2"></i>
                                        <h6>{{ __('Upload New Images') }}</h6>
                                        <input type="file" name="images[]" id="images" class="form-control mt-3" multiple accept="image/*">
                                        <p class="text-muted small mt-2">{{ __('Supported: JPG, PNG, WEBP. You can select multiple.') }}</p>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-check form-switch mt-2">
                                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
                                               {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-bold" for="is_active">
                                            {{ __('Active and published') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-light py-3 d-flex justify-content-between">
                            <a href="{{ route('Admin.products.index') }}" class="btn btn-secondary px-4">{{ __('Back') }}</a>
                            <button type="submit" class="btn btn-primary px-5 shadow">
                                <i class="feather icon-save me-2"></i>{{ __('Update Product') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .border-dashed { border: 2px dashed #cbd5e1; transition: all 0.3s; }
    .border-dashed:hover { border-color: #5d87ff; background-color: #f0f7ff !important; }
    .nav-pills .nav-link.active { background-color: #5d87ff; box-shadow: 0 4px 10px rgba(93, 135, 255, 0.3); }
    .delete-image { border-radius: 50%; width: 30px; height: 30px; padding: 0; line-height: 30px; }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // حذفة صورة عبر Ajax
        $('.delete-image').on('click', function() {
            let imageId = $(this).data('id');
            let container = $('#image-box-' + imageId);

            Swal.fire({
                title: "{{ __('Are you sure?') }}",
                text: "{{ __('This image will be permanently deleted!') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: "{{ __('Yes, delete it!') }}"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('admin/products/image') }}/" + imageId,
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            container.fadeOut(400, function() { $(this).remove(); });
                            Swal.fire('Deleted!', "{{ __('Image has been removed.') }}", 'success');
                        },
                        error: function() {
                            Swal.fire('Error!', 'Something went wrong.', 'error');
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
@endsection
