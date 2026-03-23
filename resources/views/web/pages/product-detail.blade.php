@extends('web.layouts.app')

@section('content')
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-md-push-2">
                    <div id="product-main-img">
                        @foreach ($product->images as $image)
                            <div class="product-preview">
                                <img src="{{ asset($image->image) }}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-2 col-md-pull-5">
                    <div id="product-imgs">
                        @foreach ($product->images as $image)
                            <div class="product-preview">
                                <img src="{{ asset($image->image) }}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="product-details">
                        <h2 class="product-name">{{ $product->name[app()->getLocale()] }}</h2>
                        <div>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <a class="review-link" href="#">10 Review(s) | Add your review</a>
                        </div>
                        <div>
                            <h3 class="product-price">${{ $product->discounted_price }}
                                <del class="product-old-price">${{ $product->price }}</del>
                            </h3>
                            <span class="product-available">{{ __('In Stock') }}</span>
                        </div>
                        <p>{{ $product->description[app()->getLocale()] }}</p>

                        <div class="add-to-cart">
                            <div class="qty-label">
                                {{ __('Qty') }}
                                <div class="input-number">
                                    {{-- القالب (Electro) هيتعامل مع الـ qty-up والـ qty-down تلقائياً --}}
                                    <input type="number" id="main-product-qty" value="1" min="1">
                                    <span class="qty-up">+</span>
                                    <span class="qty-down">-</span>
                                </div>
                            </div>
                            <button class="add-to-cart-btn" data-product-id="{{ $product->id }}">
                                <i class="fa fa-shopping-cart"></i> {{ __('add to cart') }}
                            </button>
                        </div>

                        <ul class="product-btns">
                            <li>
                                <a href="#" class="add-to-wishlist" data-product-id="{{ $product->id }}">
                                    <i class="favorite-icon {{ $product->favorite ? 'fa fa-heart' : 'fa fa-heart-o' }}"
                                       style="font-size:16px; color: {{ $product->favorite ? 'red' : 'inherit' }};">
                                    </i>
                                    add to wishlist
                                </a>
                            </li>
                        </ul>

                        <ul class="product-links">
                            <li>{{ __('Category:') }}</li>
                            <li><a href="#">{{ $product->category->name[app()->getLocale()] }}</a></li>
                        </ul>

                        <ul class="product-links">
                            <li>{{ __('Share:') }}</li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                        </ul>
                    </div>
                </div>
                </div>
            </div>
        </div>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h3 class="title">{{ __('Related Products') }}</h3>
                    </div>
                </div>

                @foreach ($relatedProducts as $relatedProduct)
                    <div class="col-md-3 col-xs-6">
                        <div class="product">
                            <div class="product-img">
                                <img src="{{ asset($relatedProduct->images->first()->image) }}" alt="">
                                @if($relatedProduct->price > $relatedProduct->discounted_price)
                                    <div class="product-label">
                                        <span class="sale">-{{ round((($relatedProduct->price - $relatedProduct->discounted_price)/$relatedProduct->price)*100) }}%</span>
                                    </div>
                                @endif
                            </div>
                            <div class="product-body">
                                <p class="product-category">{{ $relatedProduct->category->name[app()->getLocale()] }}</p>
                                <h3 class="product-name">
                                    <a href="{{ route('products.detail', $relatedProduct->id) }}">{{ $relatedProduct->name[app()->getLocale()] }}</a>
                                </h3>
                                <h4 class="product-price">${{ $relatedProduct->discounted_price }} <del class="product-old-price">${{ $relatedProduct->price }}</del></h4>
                                <div class="product-btns">
                                    <button type="button" class="add-to-wishlist" data-product-id="{{ $relatedProduct->id }}">
                                        <i class="favorite-icon {{ $relatedProduct->favorite ? 'fa fa-heart' : 'fa fa-heart-o' }}"
                                           style="color: {{ $relatedProduct->favorite ? 'red' : 'inherit' }};"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="add-to-cart">
                                <button class="add-to-cart-btn" data-product-id="{{ $relatedProduct->id }}">
                                    <i class="fa fa-shopping-cart"></i> {{ __('add to cart') }}
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            });

            // إضافة للسلة Ajax
            $(document).on('click', '.add-to-cart-btn', function(e) {
                e.preventDefault();
                var button = $(this);
                var productId = button.data('product-id');

                // سحب الكمية: لو الزرار في منطقة التفاصيل الرئيسية يسحب من الـ Input بتاعها
                var quantity = 1;
                if (button.closest('.product-details').length > 0) {
                    quantity = $('#main-product-qty').val();
                }

                $.post('{{ route('carts.store') }}', {
                    product_id: productId,
                    quantity: quantity
                })
                .done(function(response) {
                    toastr.success(response.message || 'تم إضافة المنتج إلى السلة');
                    $('#cart-count').text(response.cart_count);
                    $('.js-cart-count').text(response.cart_count);
                    $('#cart-content-wrapper').html(response.cart_html);
                })
                .fail(function(xhr) {
                    if (xhr.status === 401) toastr.warning('يجب تسجيل الدخول أولاً');
                    else toastr.error('حدث خطأ أثناء الإضافة');
                });
            });

            // إضافة للمفضلة Ajax
            $(document).on('click', '.add-to-wishlist', function(e) {
                e.preventDefault();
                var button = $(this);
                var productId = button.data('product-id');
                var icon = button.find('.favorite-icon');

                $.post('{{ route('favorites.store') }}', { product_id: productId })
                .done(function(response) {
                    if (icon.hasClass('fa-heart-o')) {
                        icon.removeClass('fa-heart-o').addClass('fa-heart').css('color', 'red');
                        toastr.success('تمت الإضافة للمفضلة');
                    } else {
                        icon.removeClass('fa-heart').addClass('fa-heart-o').css('color', 'inherit');
                        toastr.info('تمت الإزالة من المفضلة');
                    }
                })
                .fail(function(xhr) {
                    if (xhr.status === 401) toastr.warning('يجب تسجيل الدخول أولاً');
                });
            });
        });
    </script>
@endpush
