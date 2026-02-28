@extends('web.layouts.app')
@section('content')
    <!-- SECTION -->
    @php
        $hasSearch = request()->filled('query');
    @endphp
    <!-- HOT DEAL SECTION -->
    <div id="hot-deal" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="hot-deal">
                        <ul class="hot-deal-countdown">
                            <li>
                                <div>
                                    <h3>02</h3>
                                    <span>Days</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>10</h3>
                                    <span>Hours</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>34</h3>
                                    <span>Mins</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>60</h3>
                                    <span>Secs</span>
                                </div>
                            </li>
                        </ul>
                        <h2 class="text-uppercase">hot deal this week</h2>
                        <p>New Collection Up to 50% OFF</p>
                        <a class="primary-btn cta-btn" href="#">Shop now</a>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /HOT DEAL SECTION -->


    @if ($hasSearch)
        <!-- SEARCH RESULTS -->
        <div class="section" id="products-section">
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <div class="section-title">
                            <h3 class="title">
                                نتائج البحث عن: "{{ request('query') }}"
                            </h3>
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
                                            <p class="product-category">
                                                {{ $product->category->name[app()->getLocale()] }}
                                            </p>

                                            <h3 class="product-name">
                                                <a href="{{ route('products.detail', $product->id) }}">
                                                    {{ $product->name[app()->getLocale()] }}
                                                </a>
                                            </h3>

                                            <h4 class="product-price">
                                                ${{ $product->discounted_price }}
                                                <del class="product-old-price">${{ $product->price }}</del>
                                            </h4>
                                        </div>
                                        
                                    </div>
                                </div>
                            @empty
                                <div class="col-md-12 text-center">
                                    <p>لا توجد نتائج مطابقة</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @else





    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">{{ __('Products') }}</h3>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav nav nav-tabs">
                                @foreach ($categories as $index => $category)
                                    <li class="{{ $index == 0 ? 'active' : '' }}">
                                        <a data-toggle="tab" href="#tab{{ $category->id }}">
                                            {{ $category->name[app()->getLocale()] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs tab-content">
                            @foreach ($categories as $index => $category)
                                <div id="tab{{ $category->id }}"
                                    class="tab-pane fade {{ $index == 0 ? 'in active show' : '' }}">
                                    <div class="products-slick" data-nav="#slick-nav-{{ $category->id }}">

                                        @foreach ($products->where('category_id', $category->id) as $product)
                                            <!-- product -->
                                            <div class="product">
                                                <div class="product-img">
                                                    <img src="{{ $product->images->first()->image }}" alt="">
                                                    <div class="product-label">
                                                        @php
                                                            $discountPercent = 0;
                                                            if ($product->price > 0) {
                                                                $discountPercent =
                                                                    (($product->price - $product->discounted_price) /
                                                                        $product->price) *
                                                                    100;
                                                            }
                                                        @endphp
                                                        @if ($discountPercent > 0)
                                                            <span class="sale">-{{ round($discountPercent) }}%</span>
                                                        @endif
                                                        <span class="new">{{ $product->status }}</span>
                                                    </div>
                                                </div>
                                                <div class="product-body">
                                                    <p class="product-category">
                                                        {{ $product->category->name[app()->getLocale()] }}</p>
                                                    <h3 class="product-name"><a
                                                            href="{{ route('products.detail', $product->id) }}">{{ $product->name[app()->getLocale()] }}</a>
                                                    </h3>
                                                    <h4 class="product-price">${{ $product->discounted_price }} <del
                                                            class="product-old-price">${{ $product->price }}</del>
                                                    </h4>
                                                    <div class="product-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <div class="product-btns">
                                                        {{-- <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span
                                                                class="tooltipp">add to wishlist</span></button>  --}}

                                                        <button type="button" class="add-to-wishlist"
                                                            data-product-id="{{ $product->id }}" data-toggle="tooltip"
                                                            data-placement="top" title="Add To Favorite">
                                                            <i class="fa fa-heart-o favorite-icon {{ $product->favorite && $product->favorite->favorite_type ? 'fas' : 'far' }}"
                                                                style="font-size:18px; color: {{ $product->favorite && $product->favorite->favorite_type ? 'red' : 'inherit' }};"></i>
                                                        </button>
                                                        <button class="add-to-compare"><i class="fa fa-exchange"></i><span
                                                                class="tooltipp">add to compare</span></button>
                                                        <button class="quick-view"><i class="fa fa-eye"></i><span
                                                                class="tooltipp">quick view</span></button>

                                                    </div>
                                                </div>
                                                <div class="add-to-cart">
                                                    {{-- <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>  --}}

                                                    <button class="add-to-cart-btn" data-product-id="{{ $product->id }}">
                                                        <i class="fa fa-shopping-cart"></i> add to cart
                                                    </button>


                                                </div>
                                            </div>
                                            <!-- /product -->
                                        @endforeach

                                    </div>

                                    <div id="slick-nav-{{ $category->id }}" class="products-slick-nav"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- /Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
@endif
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-4 col-xs-6">
                    <div class="section-title">
                        <h4 class="title">{{ __('Top selling') }}</h4>
                        <div class="section-nav">
                            <div id="slick-nav-3" class="products-slick-nav"></div>
                        </div>
                    </div>

                    <div class="products-widget-slick" data-nav="#slick-nav-3">
                        @foreach ($products as $product)
                            <div>
                                <!-- product widget -->
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="{{ $product->images->first()->image }}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $product->category->name[app()->getLocale()] }}</p>
                                        <h3 class="product-name"><a
                                                href="{{ route('products.detail', $product->id) }}">{{ $product->name[app()->getLocale()] }}</a>
                                        </h3>
                                        <h4 class="product-price">{{ $product->discounted_price }} <del
                                                class="product-old-price">{{ $product->price }}</del></h4>
                                    </div>
                                </div>
                                <!-- /product widget -->

                            </div>
                        @endforeach



                    </div>
                </div>

                <div class="col-md-4 col-xs-6">
                    <div class="section-title">
                        <h4 class="title">Top selling</h4>
                        <div class="section-nav">
                            <div id="slick-nav-4" class="products-slick-nav"></div>
                        </div>
                    </div>

                    <div class="products-widget-slick" data-nav="#slick-nav-4">
                        <div>
                            @foreach ($products as $product)
                                <div>
                                    <!-- product widget -->
                                    <div class="product-widget">
                                        <div class="product-img">
                                            <img src="{{ $product->images->first()->image }}" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">{{ $product->category->name[app()->getLocale()] }}
                                            </p>
                                            <h3 class="product-name"><a
                                                    href="{{ route('products.detail', $product->id) }}">{{ $product->name[app()->getLocale()] }}</a>
                                            </h3>
                                            <h4 class="product-price">{{ $product->discounted_price }} <del
                                                    class="product-old-price">{{ $product->price }}</del></h4>
                                        </div>
                                    </div>
                                    <!-- /product widget -->

                                </div>
                            @endforeach


                        </div>


                    </div>
                </div>

                <div class="clearfix visible-sm visible-xs"></div>

                <div class="col-md-4 col-xs-6">
                    <div class="section-title">
                        <h4 class="title">Top selling</h4>
                        <div class="section-nav">
                            <div id="slick-nav-5" class="products-slick-nav"></div>
                        </div>
                    </div>

                    <div class="products-widget-slick" data-nav="#slick-nav-5">
                        <div>
                            @foreach ($products as $product)
                                <div>
                                    <!-- product widget -->
                                    <div class="product-widget">
                                        <div class="product-img">
                                            <img src="{{ $product->images->first()->image }}" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">{{ $product->category->name[app()->getLocale()] }}
                                            </p>
                                            <h3 class="product-name"><a
                                                    href="{{ route('products.detail', $product->id) }}">{{ $product->name[app()->getLocale()] }}</a>
                                            </h3>
                                            <h4 class="product-price">{{ $product->discounted_price }} <del
                                                    class="product-old-price">{{ $product->price }}</del></h4>
                                        </div>
                                    </div>
                                    <!-- /product widget -->

                                </div>
                            @endforeach



                        </div>


                    </div>
                </div>

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->


@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            // إضافة للسلة
            $(document).on('click', '.add-to-cart-btn', function(e) {
                e.preventDefault();
                var productId = $(this).data('product-id');

                $.post('{{ route('carts.store') }}', {
                        product_id: productId
                    })
                    .done(function(response) {
                        toastr.success('تم إضافة المنتج إلى السلة');
                    })
                    .fail(function(xhr) {
                        if (xhr.status === 401) {
                            toastr.warning('يجب عليك تسجيل الدخول أولاً');
                        } else {
                            toastr.error('حدث خطأ أثناء الإضافة للسلة');
                        }
                        console.error(xhr.responseText);
                    });
            });

            // إضافة للمفضلة
            $(document).on('click', '.add-to-wishlist', function(e) {
                e.preventDefault();
                var button = $(this);
                var productId = button.data('product-id');

                $.post('{{ route('favorites.store') }}', {
                        product_id: productId
                    })
                    .done(function(response) {
                        var icon = button.find('.favorite-icon');
                        if (icon.hasClass('far')) {
                            icon.removeClass('far').addClass('fas').css('color', 'red');
                            toastr.success('تمت الإضافة إلى المفضلة');
                        } else {
                            icon.removeClass('fas').addClass('far').css('color', 'inherit');
                            toastr.info('تمت الإزالة من المفضلة');
                        }
                    })
                    .fail(function(xhr) {
                        if (xhr.status === 401) {
                            toastr.warning('يجب عليك تسجيل الدخول أولاً');
                        } else {
                            toastr.error('حدث خطأ أثناء الإضافة للمفضلة');
                        }
                        console.error(xhr.responseText);
                    });
            });
        });
    </script>
@endpush
