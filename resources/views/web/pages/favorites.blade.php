@extends('web.layouts.app')

@section('content')
<div class="wishlist-page-wrapper py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <div class="wishlist-header">
                    <h1 class="display-6 fw-bold text-dark mb-2">{{ __('Wishlist') }}</h1>
                    <p class="text-muted">{{ __('Your favorite products saved for later') }}</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                @if($data->isEmpty())
                    <div class="empty-state text-center py-5 bg-white rounded-4 shadow-sm">
                        <div class="icon-box mb-4">
                            <i class="las la-heart text-light" style="font-size: 5rem;"></i>
                        </div>
                        <h3 class="fw-bold">{{ __('Your wishlist is empty.') }}</h3>
                        <p class="text-muted">{{ __('Start adding products you love to your wishlist!') }}</p>
                        <a href="/" class="btn btn-primary btn-lg rounded-pill px-5 mt-3 shadow-sm">{{ __('Explore Shop') }}</a>
                    </div>
                @else
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0 custom-wishlist-table">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="ps-4 py-3 text-uppercase small fw-bold text-muted">{{ __('Product') }}</th>
                                            <th class="py-3 text-uppercase small fw-bold text-muted text-center">{{ __('Price') }}</th>
                                            <th class="py-3 text-uppercase small fw-bold text-muted text-end pe-4">{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $favorit)
                                            <tr>
                                                <td class="ps-4 py-4">
                                                    <div class="d-flex align-items-center">
                                                        <form action="{{ route('favorites.delete', $favorit->id) }}" method="POST" class="me-3">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn-remove-wishlist" title="{{ __('Remove') }}">
                                                                <i class="las la-times"></i>
                                                            </button>
                                                        </form>

                                                        <div class="product-img-box me-3">
                                                            <img src="{{ asset($favorit->product->images->first()->image ?? 'default.png') }}"
                                                                 alt="product" class="rounded-3 border shadow-sm">
                                                        </div>

                                                        <div>
                                                            <h6 class="mb-0 fw-bold text-dark">{{ $favorit->product->{'product_name_' . app()->getLocale()} }}</h6>
                                                            <small class="text-muted">In Stock</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <span class="fw-bold text-primary fs-5">{{ number_format($favorit->product->price, 2) }} <small>ج.م</small></span>
                                                </td>
                                                <td class="text-end pe-4">
                                                    <form action="{{ route('carts.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $favorit->product->id }}">
                                                        <input type="hidden" name="quantity" value="1">
                                                        <button type="submit" class="btn btn-dark btn-sm rounded-pill px-4 py-2 fw-bold shadow-sm hover-up">
                                                            <i class="las la-shopping-cart me-1"></i> {{ __('Add To Cart') }}
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
:root {
    --primary-color: #4361ee;
    --soft-gray: #f8fafc;
    --border-color: #e2e8f0;
}

.wishlist-page-wrapper {
    background-color: var(--soft-gray);
    min-height: 100vh;
}

/* ====== TABLE CUSTOMIZATION ====== */
.custom-wishlist-table {
    border-collapse: separate;
    border-spacing: 0;
}

.custom-wishlist-table thead th {
    border: none;
    letter-spacing: 0.5px;
}

.custom-wishlist-table tbody tr {
    transition: all 0.2s ease;
}

.custom-wishlist-table tbody tr:hover {
    background-color: #fdfdfd;
}

/* ====== PRODUCT IMAGE ====== */
.product-img-box {
    width: 70px;
    height: 70px;
    flex-shrink: 0;
}

.product-img-box img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    background: #fff;
}

/* ====== BUTTONS ====== */
.btn-remove-wishlist {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    border: none;
    background: #fee2e2;
    color: #ef4444;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
}

.btn-remove-wishlist:hover {
    background: #ef4444;
    color: #fff;
    transform: scale(1.1);
}

.hover-up {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-up:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
}

/* ====== EMPTY STATE ====== */
.empty-state .icon-box {
    display: inline-block;
    padding: 30px;
    background: #f1f5f9;
    border-radius: 50%;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .custom-wishlist-table thead { display: none; }
    .custom-wishlist-table tr {
        display: block;
        border-bottom: 1px solid var(--border-color);
        padding: 15px 10px;
    }
    .custom-wishlist-table td {
        display: block;
        width: 100%;
        text-align: center !important;
        padding: 10px 0;
        border: none;
    }
    .custom-wishlist-table td:first-child .d-flex {
        flex-direction: column;
    }
    .btn-remove-wishlist {
        margin: 0 auto 10px !important;
    }
    .product-img-box {
        margin: 0 auto 10px !important;
    }
}
</style>
@endpush
