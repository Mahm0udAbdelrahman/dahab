@extends('web.layouts.app')

@section('content')
<div class="wishlist-page-wrapper section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <div class="wishlist-header">
                    <h1 class="display-6 fw-bold text-dark mb-2" style="font-weight: 800; text-transform: uppercase;">{{ __('Wishlist') }}</h1>
                    <div class="wishlist-line"></div>
                    <p class="text-muted">{{ __('Your favorite products saved for later') }}</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                @if($data->isEmpty())
                    <div class="empty-state text-center py-5 bg-white rounded-4 shadow-sm border">
                        <div class="icon-box mb-4">
                            <i class="fa fa-heart-o text-light" style="font-size: 5rem; color: #eee !important;"></i>
                        </div>
                        <h3 class="fw-bold">{{ __('Your wishlist is empty.') }}</h3>
                        <p class="text-muted">{{ __('Start adding products you love to your wishlist!') }}</p>
                        <a href="{{ url('/') }}" class="primary-btn mt-3 shadow-sm" style="border-radius: 50px; padding: 12px 40px;">{{ __('Explore Shop') }}</a>
                    </div>
                @else
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden wishlist-card">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table align-middle mb-0 custom-wishlist-table">
                                    <thead>
                                        <tr>
                                            <th class="ps-4 py-4 text-uppercase small fw-bold">{{ __('Product') }}</th>
                                            <th class="py-4 text-uppercase small fw-bold text-center">{{ __('Price') }}</th>
                                            <th class="py-4 text-uppercase small fw-bold text-end pe-4">{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $favorit)
                                            <tr class="wishlist-row" id="wishlist-item-{{ $favorit->id }}">
                                                <td class="ps-4 py-4">
                                                    <div class="d-flex align-items-center">
                                                        {{-- زرار الحذف Ajax --}}
                                                        <button type="button" class="btn-remove-wishlist me-3 delete-favorite"
                                                                data-id="{{ $favorit->id }}" title="{{ __('Remove') }}">
                                                            <i class="fa fa-close"></i>
                                                        </button>

                                                        <div class="product-img-box me-3">
                                                            <img src="{{ asset($favorit->product->images->first()->image ?? 'img/default.png') }}"
                                                                 alt="product" class="rounded-3 border shadow-sm">
                                                        </div>

                                                        <div>
                                                            <h6 class="mb-0 fw-bold text-dark product-title-wishlist">
                                                                {{ $favorit->product->name[app()->getLocale()] ?? $favorit->product->name }}
                                                            </h6>
                                                            <span class="stock-status"><i class="fa fa-check-circle"></i> In Stock</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <span class="wishlist-price">{{ number_format($favorit->product->price, 0) }} <span>EGP</span></span>
                                                </td>
                                                <td class="text-end pe-4">
                                                    {{-- زرار الإضافة للسلة Ajax --}}
                                                    <button type="button" class="add-to-cart-btn primary-btn btn-sm px-4 py-2"
                                                            data-product-id="{{ $favorit->product->id }}"
                                                            style="border-radius: 50px; font-size: 12px; font-weight: 700; text-transform: uppercase;">
                                                        <i class="fa fa-shopping-cart me-1"></i> {{ __('Add To Cart') }}
                                                    </button>
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
    .wishlist-page-wrapper {
        background-color: #fbfbfb;
        min-height: 80vh;
    }

    .wishlist-line {
        width: 60px;
        height: 3px;
        background-color: #D10024;
        margin: 10px auto 20px;
    }

    /* ====== TABLE ====== */
    .wishlist-card {
        border: 1px solid #eee !important;
        border-radius: 15px !important;
    }

    .custom-wishlist-table thead {
        background-color: #2B2D42;
        color: #fff;
    }

    .wishlist-row {
        transition: all 0.3s ease;
    }

    .wishlist-row:hover {
        background-color: #fcfcfc;
    }

    /* ====== PRODUCT ====== */
    .product-img-box {
        width: 80px;
        height: 80px;
        background: #fff;
        padding: 5px;
        border-radius: 10px;
    }

    .product-img-box img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .product-title-wishlist {
        font-size: 15px;
        margin-bottom: 5px;
    }

    .stock-status {
        font-size: 12px;
        color: #28a745;
        font-weight: 600;
    }

    .wishlist-price {
        font-size: 18px;
        font-weight: 800;
        color: #D10024;
    }

    .wishlist-price span {
        font-size: 12px;
        color: #888;
    }

    /* ====== REMOVE BUTTON ====== */
    .btn-remove-wishlist {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 1px solid #eee;
        background: #fff;
        color: #888;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .btn-remove-wishlist:hover {
        background: #D10024;
        color: #fff;
        border-color: #D10024;
        transform: rotate(90deg);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .custom-wishlist-table thead { display: none; }
        .wishlist-row {
            display: block;
            border-bottom: 1px solid #eee;
            padding: 20px 10px;
            text-align: center;
        }
        .wishlist-row td {
            display: block;
            width: 100% !important;
            padding: 10px 0 !important;
        }
        .wishlist-row td .d-flex {
            flex-direction: column;
        }
        .btn-remove-wishlist {
            margin: 0 auto 15px !important;
        }
        .product-img-box {
            margin: 0 auto 15px !important;
        }
    }
</style>
@endpush

@push('js')
<script>
    $(document).ready(function() {
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });

        // حذف من المفضلة Ajax
        $(document).on('click', '.delete-favorite', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var row = $('#wishlist-item-' + id);

            if(confirm('{{ __("Are you sure you want to remove this item?") }}')) {
                $.ajax({
                    url: "{{ url('favorites-delete') }}/" + id,
                    type: 'DELETE',
                    success: function(response) {
                        row.fadeOut(400, function() {
                            $(this).remove();
                            if ($('tbody tr').length == 0) {
                                location.reload(); // ريفريش عشان يظهر الـ Empty State
                            }
                        });
                        toastr.success('{{ __("Item removed successfully") }}');
                    },
                    error: function() {
                        toastr.error('{{ __("Something went wrong!") }}');
                    }
                });
            }
        });

        // إضافة للسلة Ajax (بما إننا مبرمجينها في الـ Layout أو صفحات تانية)
        $(document).on('click', '.add-to-cart-btn', function(e) {
            e.preventDefault();
            var productId = $(this).data('product-id');
            $.post('{{ route("carts.store") }}', { product_id: productId, quantity: 1 })
                .done(function(response) {
                    toastr.success(response.message || '{{ __("Added to cart successfully") }}');
                    $('#cart-count').text(response.cart_count);
                    $('.js-cart-count').text(response.cart_count);
                    $('#cart-content-wrapper').html(response.cart_html);
                })
                .fail(function() { toastr.error('{{ __("Failed to add to cart") }}'); });
        });
    });
</script>
@endpush
