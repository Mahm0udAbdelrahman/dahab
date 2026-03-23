@extends('web.layouts.app')

@section('content')
<div class="cart-premium-wrapper">
    <div class="container py-5">
        <div class="d-flex align-items-center justify-content-between mb-5">
            <div>
                <h1 class="display-5 fw-bold text-dark mb-1">{{ __('My Bag') }}</h1>
                <p class="text-muted mb-0">{{ $items->count() }} {{ __('items in your bag') }}</p>
            </div>
            <a href="/" class="btn btn-outline-dark rounded-pill px-4 fw-bold d-none d-md-inline-block">
                <i class="las la-arrow-left me-2"></i> {{ __('Continue Shopping') }}
            </a>
        </div>

         <!-- Flash Message -->
        @if(Session::has('message'))
            <div class="alert alert-{{ Session::get('message.type') }} alert-dismissible">
                {{ Session::get('message.text') }}
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        @endif

        @if($items->isEmpty())
            <div class="text-center py-5 my-5">
                <div class="mb-4">
                    <img src="https://cdn-icons-png.flaticon.com/512/11329/11329060.png" width="120" style="opacity: 0.5">
                </div>
                <h3 class="fw-bold mb-3">{{ __('Your bag is empty') }}</h3>
                <p class="text-muted mb-4">{{ __('Looks like you haven\'t made your choice yet.') }}</p>
                <a href="/" class="btn btn-dark btn-lg rounded-pill px-5 py-3">{{ __('Start Shopping') }}</a>
            </div>
        @else
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="cart-items-list">
                    @foreach ($items as $item)
                    <div class="cart-item-premium mb-4" data-item-id="{{ $item->id }}" data-price="{{ $item->product->price }}">
                        <div class="row align-items-center">
                            <div class="col-4 col-md-3 col-lg-2">
                                <div class="premium-img-container">
                                    <img src="{{ asset($item->product->images->first()->image ?? 'default.png') }}" class="img-fluid">
                                </div>
                            </div>

                            <div class="col-8 col-md-9 col-lg-10">
                                <div class="row h-100 align-items-center">
                                    <div class="col-md-5 mb-2 mb-md-0">
                                        <h5 class="fw-bold text-dark mb-1">{{ $item->product->{'product_name_' . app()->getLocale()} }}</h5>
                                        <div class="text-muted small mb-2">{{ __('Unit Price:') }} {{ number_format($item->product->price, 2) }}</div>
                                    </div>

                                    <div class="col-6 col-md-3">
                                        <div class="qty-premium">
                                            <button class="qty-btn minus"><i class="las la-minus"></i></button>
                                            <input type="number" class="qty-input" value="{{ $item->quantity }}" data-id="{{ $item->id }}" readonly>
                                            <button class="qty-btn plus"><i class="las la-plus"></i></button>
                                        </div>
                                    </div>

                                    <div class="col-6 col-md-4 text-end d-flex flex-column align-items-end justify-content-center">
                                        <div class="fw-bold fs-5 mb-2 item-subtotal">{{ number_format($item->product->price * $item->quantity, 2) }} ج.م</div>
                                        <form action="{{ route('carts.destroy', $item->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-remove-premium">
                                                <i class="las la-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-4">
                <div class="summary-card-premium sticky-top" style="top: 30px; z-index: 10;">
                    <h4 class="fw-bold mb-4">{{ __('Summary') }}</h4>

                    <div class="d-flex justify-content-between mb-3 text-muted">
                        <span>{{ __('Subtotal') }}</span>
                        <span id="summary-subtotal">{{ number_format($total, 2) }} ج.م</span>
                    </div>
                    <div class="d-flex justify-content-between mb-4 pb-4 border-bottom">
                        <span>{{ __('Shipping') }}</span>
                        <span class="text-dark fw-bold">{{ __('Free') }}</span>
                    </div>

                    <div class="d-flex justify-content-between mb-4 align-items-center">
                        <span class="fw-bold fs-5">{{ __('Total') }}</span>
                        <span class="fw-bold fs-4 text-dark" id="cart-total">{{ number_format($total, 2) }} ج.م</span>
                    </div>

                    <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label class="form-label-premium">{{ __('Payment') }}</label>
                            <div class="select-wrapper">
                                <select name="payment_status" id="payment-status-select" class="form-control-premium" required>
                                    <option value="cash">💵 {{ __('Cash on Delivery') }}</option>
                                    <option value="instapay">⚡ {{ __('Instapay') }}</option>
                                    <option value="vodafonecash">🔴 {{ __('Vodafone Cash') }}</option>
                                </select>
                                <i class="las la-angle-down select-icon"></i>
                            </div>
                        </div>

                        <!-- Payment Modal -->
                        <div class="modal fade" id="paymentDetailsModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content border-0 shadow-lg rounded-4">
                                    <div class="modal-header border-0 pb-0">
                                        <button type="button" class="close px-3 py-2" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" class="fs-4">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center p-4">
                                        <div id="modal-vodafone-info" class="d-none">
                                            <div class="mb-3">
                                                <i class="la la-mobile fs-1 text-danger" style="font-size: 80px;"></i>
                                            </div>
                                            <h4 class="fw-bold text-danger mb-3">فودافون كاش</h4>
                                            <p class="mb-2 fs-5">يرجى تحويل المبلغ إلى الرقم التالي:</p>
                                            <div class="bg-light p-3 rounded-3 mb-4">
                                                <span class="fw-bold fs-3 text-dark">{{ $setting->vodafonecash ?? '01062612997' }}</span>
                                            </div>
                                            <p class="text-muted small">بعد التحويل، يرجى إرفاق صورة الإيصال (الوصل) في الأسفل لتأكيد الطلب.</p>
                                        </div>
                                        
                                        <div id="modal-instapay-info" class="d-none">
                                            <div class="mb-3">
                                                <i class="la la-bolt fs-1 text-info" style="font-size: 80px;"></i>
                                            </div>
                                            <h4 class="fw-bold text-info mb-3">انستاباي</h4>
                                            <p class="mb-2 fs-5">يرجى تحويل المبلغ إلى العنوان/الرقم التالي:</p>
                                            <div class="bg-light p-3 rounded-3 mb-4">
                                                <span class="fw-bold fs-3 text-dark">{{ $setting->instapay ?? '01146613334' }}</span>
                                            </div>
                                            <p class="text-muted small">{{ __('After transferring, please attach a screenshot of the receipt below to confirm the order.') }}</p>
                                        </div>
                                        
                                        <button type="button" class="btn btn-dark btn-lg w-100 rounded-pill mt-3" data-dismiss="modal">{{ __('Understood, I will pay now') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label-premium">{{ __('Name') }}</label>
                            <input type="text" name="name" class="form-control-premium" placeholder="{{ __('Your Full Name') }}"
                                value="{{ auth()->user()->name ?? '' }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label-premium">{{ __('Phone') }}</label>
                            <input type="text" name="phone" class="form-control-premium" placeholder="{{ __('Mobile Number') }}"
                                value="{{ auth()->user()->phone ?? '' }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label-premium">{{ __('Address') }}</label>
                            <input type="text" name="address" class="form-control-premium" placeholder="{{ __('Shipping Address') }}"
                                value="{{ auth()->user()->address ?? '' }}" required>
                        </div>

                        <div class="form-group mb-4" id="wasl-input-container">
                            <label class="form-label-premium">{{ __('Wasl (Receipt Receipt)') }}</label>
                            <input type="file" name="wasl" class="form-control-premium" placeholder="{{ __('Wasl') }}">
                            <small class="text-muted d-block mt-1">{{ __('Please upload a screenshot of your transfer.') }}</small>
                        </div>

                        <button type="submit" class="btn btn-info btn-lg w-100 py-3 rounded-pill fw-bold checkout-btn shadow-lg">
                            {{ __('Checkout') }}
                        </button>
                    </form>

                    <div class="mt-4 text-center">
                        <p class="small text-muted mb-0"><i class="las la-lock me-1"></i> {{ __('Secure Checkout') }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('css')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&family=Cairo:wght@400;600;700&display=swap');

    :root {
        --bg-color: #f8f9fa;
        --card-bg: #ffffff;
        --text-dark: #111111;
        --border-color: #eeeeee;
        --primary-btn: #111111;
    }

    body {
        background-color: var(--bg-color);
        font-family: 'Outfit', 'Cairo', sans-serif;
        color: var(--text-dark);
    }

    /* Premium Image Container */
    .premium-img-container {
        width: 100%;
        aspect-ratio: 1;
        background-color: #f4f4f4;
        border-radius: 16px;
        padding: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .premium-img-container img {
        max-width: 100%;
        max-height: 100%;
        mix-blend-mode: multiply;
        transition: transform 0.3s ease;
    }
    .cart-item-premium:hover .premium-img-container img {
        transform: scale(1.05);
    }

    /* Cart Item Styling */
    .cart-item-premium {
        background: var(--card-bg);
        border-radius: 20px; /* More rounded */
        padding: 15px;
        transition: transform 0.2s;
        border-bottom: 1px solid transparent;
    }

    /* Quantity Selector (Pill Shape) */
    .qty-premium {
        background: #f1f1f1;
        border-radius: 50px;
        padding: 5px;
        display: inline-flex;
        align-items: center;
        justify-content: space-between;
        width: 110px;
    }
    .qty-btn {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: none;
        background: #fff;
        color: #111;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        transition: 0.2s;
    }
    .qty-btn:hover { background: #111; color: #fff; }
    .qty-input {
        width: 30px;
        background: transparent;
        border: none;
        text-align: center;
        font-weight: 700;
        font-size: 14px;
        color: #111;
    }

    /* Remove Button (Minimal) */
    .btn-remove-premium {
        background: transparent;
        border: none;
        color: #bbb;
        font-size: 18px;
        transition: 0.2s;
        padding: 0;
    }
    .btn-remove-premium:hover { color: #ff4444; transform: rotate(90deg); }

    /* Summary Card (The Hero) */
    .summary-card-premium {
        background: #ffffff;
        padding: 35px;
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.04);
        border: 1px solid rgba(0,0,0,0.02);
    }

    /* Premium Inputs */
    .form-label-premium {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #888;
        margin-bottom: 8px;
        display: block;
    }
    .form-control-premium {
        width: 100%;
        border: none;
        background: #f8f9fa;
        padding: 16px;
        border-radius: 12px;
        font-weight: 500;
        color: #111;
        margin-bottom: 10px;
        transition: 0.3s;
        outline: none;
    }
    .form-control-premium:focus {
        background: #fff;
        box-shadow: 0 0 0 2px #111; /* Focus border like Apple/Nike */
    }

    /* Custom Select */
    .select-wrapper { position: relative; }
    .select-icon {
        position: absolute;
        right: 15px; /* RTL: left: 15px */
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        font-size: 14px;
    }
    select.form-control-premium { appearance: none; cursor: pointer; }

    /* Checkout Button */
    .checkout-btn {
        background-color: #111;
        transition: 0.3s;
        letter-spacing: 0.5px;
    }
    .checkout-btn:hover {
        background-color: #333;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
    }

    /* Modal Centering (Bootstrap 3) */
    #paymentDetailsModal {
        text-align: center;
        padding: 0 !important;
    }

    #paymentDetailsModal:before {
        content: '';
        display: inline-block;
        height: 100%;
        vertical-align: middle;
        margin-right: -4px;
    }

    #paymentDetailsModal .modal-dialog {
        display: inline-block;
        text-align: initial;
        vertical-align: middle;
    }

    /* RTL Adjustments */
    [dir="rtl"] .select-icon { right: auto; left: 15px; }
    [dir="rtl"] .me-2 { margin-left: 0.5rem !important; margin-right: 0 !important; }
    [dir="rtl"] .text-end { text-align: left !important; }
</style>
@endpush

@push('js')
<script>
$(document).ready(function() {
    // تحديث الكميات
    $('.qty-btn').on('click', function(e) {
        e.preventDefault();
        let $container = $(this).closest('.qty-premium');
        let $input = $container.find('.qty-input');
        let val = parseInt($input.val());

        if ($(this).hasClass('plus')) {
            $input.val(val + 1).trigger('change');
        } else if (val > 1) {
            $input.val(val - 1).trigger('change');
        }
    });

    $('.qty-input').on('change', function() {
        let itemId = $(this).data('id');
        let qty = $(this).val();
        let $row = $(this).closest('.cart-item-premium');

        // تأثير تحميل بسيط (Opacity)
        $row.css('opacity', '0.5');

        $.ajax({
            url: '/update_cart/' + itemId,
            method: 'PUT',
            data: { _token: '{{ csrf_token() }}', quantity: qty },
            success: function(res) {
                // تحديث السعر الفرعي
                let price = parseFloat($row.data('price'));
                $row.find('.item-subtotal').text((price * qty).toLocaleString('en-US', {minimumFractionDigits: 2}) + ' ج.م');
                $row.css('opacity', '1');

                // تحديث الإجمالي الكلي
                updateTotal();
            }
        });
    });

    function updateTotal() {
        $.get('{{ route("carts.total") }}', function(res) {
            let total = parseFloat(res.total).toLocaleString('en-US', {minimumFractionDigits: 2}) + ' ج.م';
            // تحديث الأرقام بتأثير Fade
            $('#summary-subtotal, #cart-total').fadeOut(150, function() {
                $(this).text(total).fadeIn(150);
            });
        });
    }

    // Payment Info Modal Logic
    function handlePaymentChange(showModal = false) {
        let selected = $('#payment-status-select').val();
        let $vodafone = $('#modal-vodafone-info');
        let $instapay = $('#modal-instapay-info');
        let $waslContainer = $('#wasl-input-container');
        let $waslInput = $waslContainer.find('input[name="wasl"]');

        // Reset all Visibility and Required first
        $vodafone.addClass('d-none');
        $instapay.addClass('d-none');
        $waslContainer.addClass('d-none');
        $waslInput.prop('required', false);

        if (selected === 'vodafonecash') {
            $vodafone.removeClass('d-none');
            $waslContainer.removeClass('d-none');
            $waslInput.prop('required', true);
            if (showModal) $('#paymentDetailsModal').modal('show');
        } else if (selected === 'instapay') {
            $instapay.removeClass('d-none');
            $waslContainer.removeClass('d-none');
            $waslInput.prop('required', true);
            if (showModal) $('#paymentDetailsModal').modal('show');
        }
    }

    $('#payment-status-select').on('change', function() {
        handlePaymentChange(true);
    });

    // Initial trigger to hide/show correctly on load without showing modal
    handlePaymentChange(false);

    // Cleanup when modal is closed manually
    $('#paymentDetailsModal').on('hidden.bs.modal', function() {
        $('#modal-vodafone-info, #modal-instapay-info').addClass('d-none');
    });
});
</script>
@endpush
