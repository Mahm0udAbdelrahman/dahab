@extends('web.layouts.app')
@section('content')
    @php
        $hasSearch = request()->filled('query');
    @endphp
    <div id="hot-deal" class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hot-deal">
                        <ul class="hot-deal-countdown">
                            <li><div><h3>02</h3><span>Days</span></div></li>
                            <li><div><h3>10</h3><span>Hours</span></div></li>
                            <li><div><h3>34</h3><span>Mins</span></div></li>
                            <li><div><h3>60</h3><span>Secs</span></div></li>
                        </ul>
                        <h2 class="text-uppercase">hot deal this week</h2>
                        <p>New Collection Up to 50% OFF</p>
                        <a class="primary-btn cta-btn" href="#">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($hasSearch)
        <div class="section" id="products-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h3 class="title">نتائج البحث عن: "{{ request('query') }}"</h3>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            @forelse ($products as $product)
                                <div class="col-md-3 col-sm-6">
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="{{ asset($product->images->first()->image) }}" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">{{ $product->category->name[app()->getLocale()] }}</p>
                                            <h3 class="product-name">
                                                <a href="{{ route('products.detail', $product->id) }}">{{ $product->name[app()->getLocale()] }}</a>
                                            </h3>
                                            <h4 class="product-price">${{ $product->discounted_price }} <del class="product-old-price">${{ $product->price }}</del></h4>

                                            <div class="product-btns">
                                                <button type="button" class="add-to-wishlist" data-product-id="{{ $product->id }}">
                                                    <i class="favorite-icon {{ $product->favorite ? 'fa fa-heart' : 'fa fa-heart-o' }}"
                                                       style="color: {{ $product->favorite ? 'red' : 'inherit' }}; font-size: 18px;"></i>
                                                </button>
                                                <button class="quick-view" onclick="window.location.href='{{ route('products.detail', $product->id) }}'"><i class="fa fa-eye"></i></button>
                                            </div>
                                        </div>
                                        <div class="add-to-cart">
                                            <button class="add-to-cart-btn" data-product-id="{{ $product->id }}"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-md-12 text-center"><p>لا توجد نتائج مطابقة</p></div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h3 class="title">{{ __('Products') }}</h3>
                            <div class="section-nav">
                                <ul class="section-tab-nav tab-nav nav nav-tabs">
                                    @foreach ($categories as $index => $category)
                                        <li class="{{ $index == 0 ? 'active' : '' }}">
                                            <a data-toggle="tab" href="#tab{{ $category->id }}">{{ $category->name[app()->getLocale()] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="products-tabs tab-content">
                                @foreach ($categories as $index => $category)
                                    <div id="tab{{ $category->id }}" class="tab-pane fade {{ $index == 0 ? 'in active show' : '' }}">
                                        <div class="products-slick" data-nav="#slick-nav-{{ $category->id }}">
                                            @foreach ($products->where('category_id', $category->id) as $product)
                                                <div class="product">
                                                    <div class="product-img">
                                                        <img src="{{ asset($product->images->first()->image) }}" alt="">
                                                        <div class="product-label">
                                                            @if($product->price > $product->discounted_price)
                                                                <span class="sale">-{{ round((($product->price - $product->discounted_price)/$product->price)*100) }}%</span>
                                                            @endif
                                                            <span class="new">{{ $product->status }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="product-body">
                                                        <p class="product-category">{{ $product->category->name[app()->getLocale()] }}</p>
                                                        <h3 class="product-name"><a href="{{ route('products.detail', $product->id) }}">{{ $product->name[app()->getLocale()] }}</a></h3>
                                                        <h4 class="product-price">${{ $product->discounted_price }} <del class="product-old-price">${{ $product->price }}</del></h4>
                                                        <div class="product-rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
                                                        <div class="product-btns">
                                                            <button type="button" class="add-to-wishlist" data-product-id="{{ $product->id }}">
                                                                <i class="favorite-icon {{ $product->favorite ? 'fa fa-heart' : 'fa fa-heart-o' }}"
                                                                   style="color: {{ $product->favorite ? 'red' : 'inherit' }}; font-size: 18px;"></i>
                                                            </button>
                                                            <button class="quick-view" onclick="window.location.href='{{ route('products.detail', $product->id) }}'"><i class="fa fa-eye"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="add-to-cart">
                                                        <button class="add-to-cart-btn" data-product-id="{{ $product->id }}"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div id="slick-nav-{{ $category->id }}" class="products-slick-nav"></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="section">
        <div class="container">
            <div class="row">
                {{-- تكرار الـ Widget 3 مرات كما في تصميمك --}}
                @for ($i = 3; $i <= 5; $i++)
                <div class="col-md-4 col-xs-6">
                    <div class="section-title">
                        <h4 class="title">Top selling</h4>
                        <div class="section-nav"><div id="slick-nav-{{$i}}" class="products-slick-nav"></div></div>
                    </div>
                    <div class="products-widget-slick" data-nav="#slick-nav-{{$i}}">
                        <div>
                            @foreach ($products->take(3) as $product)
                                <div class="product-widget">
                                    <div class="product-img"><img src="{{ asset($product->images->first()->image) }}" alt=""></div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $product->category->name[app()->getLocale()] }}</p>
                                        <h3 class="product-name"><a href="{{ route('products.detail', $product->id) }}">{{ $product->name[app()->getLocale()] }}</a></h3>
                                        <h4 class="product-price">${{ $product->discounted_price }} <del class="product-old-price">${{ $product->price }}</del></h4>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });

            // إضافة للسلة Ajax
            $(document).on('click', '.add-to-cart-btn', function(e) {
                e.preventDefault();
                var productId = $(this).data('product-id');
                $.post('{{ route('carts.store') }}', { product_id: productId })
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

            // إضافة للمفضلة Ajax (القلب الأحمر المليان)
            $(document).on('click', '.add-to-wishlist', function(e) {
                e.preventDefault();
                var button = $(this);
                var productId = button.data('product-id');
                var icon = button.find('.favorite-icon');

                $.post('{{ route('favorites.store') }}', { product_id: productId })
                    .done(function(response) {
                        if (icon.hasClass('fa-heart-o')) {
                            // تحويل لقلب مليان أحمر
                            icon.removeClass('fa-heart-o').addClass('fa-heart').css('color', 'red');
                            toastr.success('تمت الإضافة للمفضلة');
                        } else {
                            // رجوع لقلب مفرغ
                            icon.removeClass('fa-heart').addClass('fa-heart-o').css('color', 'inherit');
                            toastr.info('تمت الإزالة من المفضلة');
                        }
                    })
                    .fail(function(xhr) {
                        if (xhr.status === 401) toastr.warning('يجب تسجيل الدخول أولاً');
                        else toastr.error('حدث خطأ ما');
                    });
            });
        });
    </script>
@endpush
