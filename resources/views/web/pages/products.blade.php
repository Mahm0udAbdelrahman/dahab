@extends('web.layouts.app')

@section('content')
    <div class="section">
        <div class="container">
            <div class="row">

                <form id="filter-form" action="{{ url()->current() }}" method="GET">
                    <div id="aside" class="col-md-3">
                        <div class="aside">
                            <h3 class="aside-title">Categories</h3>
                            <div class="checkbox-filter">
                                @foreach ($categories as $category)
                                    <div class="input-checkbox">
                                        <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                            id="category-{{ $category->id }}"
                                            {{ is_array(request('categories')) && in_array($category->id, request('categories')) ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        <label for="category-{{ $category->id }}">
                                            <span></span>
                                            {{ $category->name[app()->getLocale()] ?? ($category->name['en'] ?? 'N/A') }}
                                            <small>({{ $category->products_count }})</small>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="aside">
                            <h3 class="aside-title">Price</h3>
                            <div class="price-filter">
                                <div id="price-slider"></div>
                                <div class="input-number price-min">
                                    <input id="price-min" name="min_price" type="number" value="{{ request('min_price') }}"
                                        placeholder="Min">
                                    <span class="qty-up">+</span><span class="qty-down">-</span>
                                </div>
                                <span>-</span>
                                <div class="input-number price-max">
                                    <input id="price-max" name="max_price" type="number" value="{{ request('max_price') }}"
                                        placeholder="Max">
                                    <span class="qty-up">+</span><span class="qty-down">-</span>
                                </div>
                            </div>
                            <button type="submit" class="primary-btn" style="width: 100%; margin-top: 15px;">Apply
                                Filter</button>
                        </div>

                        <div class="aside">
                            <h3 class="aside-title">Top selling</h3>

                            @foreach ($products->take(3) as $topProduct)
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="{{ asset($topProduct->images->first()->image ?? 'img/product01.png') }}"
                                            alt="">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $topProduct->category->name[app()->getLocale()] }}
                                        </p>
                                        <h3 class="product-name"><a
                                                href="{{ route('products.detail', $topProduct->id) }}">{{ $topProduct->name[app()->getLocale()] }}</a>
                                        </h3>
                                        <h4 class="product-price">
                                            ${{ $topProduct->discounted_price ?? $topProduct->price }}
                                            @if ($topProduct->discounted_price)
                                                <del class="product-old-price">${{ $topProduct->price }}</del>
                                            @endif
                                        </h4>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </form>
                <div id="store" class="col-md-9">
                    <div class="store-filter clearfix">
                        <div class="store-sort">
                            <label>
                                Sort By:
                                <select class="input-select" name="sort"
                                    onchange="window.location.href = '{{ request()->url() }}?sort=' + this.value">
                                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest
                                    </option>
                                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price:
                                        Low to High</option>
                                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>
                                        Price: High to Low</option>
                                </select>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        @forelse($products as $product)
                            <div class="col-md-4 col-xs-6">
                                <div class="product">
                                    <div class="product-img">
                                        <img src="{{ asset($product->images->first()->image ?? 'img/product01.png') }}"
                                            alt="">
                                        <div class="product-label">
                                            @if ($product->discounted_price && $product->price > 0)
                                                @php $discount = round((($product->price - $product->discounted_price) / $product->price) * 100); @endphp
                                                <span class="sale">-{{ $discount }}%</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $product->category->name[app()->getLocale()] }}</p>
                                        <h3 class="product-name"><a
                                                href="{{ route('products.detail', $product->id) }}">{{ $product->name[app()->getLocale()] }}</a>
                                        </h3>
                                        <h4 class="product-price">
                                            ${{ $product->discounted_price ?? $product->price }}
                                            @if ($product->discounted_price)
                                                <del class="product-old-price">${{ $product->price }}</del>
                                            @endif
                                        </h4>
                                        <div class="product-rating">
                                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                class="fa fa-star"></i><i class="fa fa-star"></i>
                                        </div>

                                        <div class="product-btns">
                                            <button type="button" class="add-to-wishlist"
                                                data-product-id="{{ $product->id }}">

                                                <i class="favorite-icon {{ $product->favorite ? 'fa fa-heart' : 'fa fa-heart-o' }}"
                                                    style="color: {{ $product->favorite ? 'red' : 'inherit' }}; font-size: 18px;"></i>
                                                <span class="tooltipp">add to wishlist</span>
                                            </button>
                                            {{--  <button class="add-to-compare"><i class="fa fa-exchange"></i><span
                                                    class="tooltipp">add to compare</span></button>  --}}
                                            <button type="button" class="quick-view"
                                                onclick="window.location.href='{{ route('products.detail', $product->id) }}'">
                                                <i class="fa fa-eye"></i><span class="tooltipp">quick view</span>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="add-to-cart">
                                        <button class="add-to-cart-btn" data-product-id="{{ $product->id }}">
                                            <i class="fa fa-shopping-cart"></i> add to cart
                                        </button>
                                    </div>
                                </div>
                            </div>

                            @if ($loop->iteration % 2 == 0)
                                <div class="clearfix visible-sm visible-xs"></div>
                            @endif
                            @if ($loop->iteration % 3 == 0)
                                <div class="clearfix visible-lg visible-md"></div>
                            @endif
                        @empty
                            <div class="col-md-12 text-center">
                                <h3>No Products Found</h3>
                            </div>
                        @endforelse
                    </div>

                    <div class="store-filter clearfix">
                        <span class="store-qty">Showing {{ $products->firstItem() }}-{{ $products->lastItem() }} of
                            {{ $products->total() }}</span>
                        <div class="pull-right">
                            {{ $products->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });


            $(document).on('click', '.add-to-cart-btn', function(e) {
                e.preventDefault();
                var productId = $(this).data('product-id');
                $.post('{{ route('carts.store') }}', {
                        product_id: productId
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


            $(document).on('click', '.add-to-wishlist', function(e) {
                e.preventDefault();
                var button = $(this);
                var productId = button.data('product-id');
                var icon = button.find('.favorite-icon');

                $.post('{{ route('favorites.store') }}', {
                        product_id: productId
                    })
                    .done(function(response) {

                        if (icon.hasClass('fa-heart-o')) {
                            icon.removeClass('fa-heart-o').addClass('fa-heart').css('color', 'red');
                            toastr.success('تمت الإضافة للمفضلة');
                        }
                      
                        else {
                            icon.removeClass('fa-heart').addClass('fa-heart-o').css('color', 'inherit');
                            toastr.info('تمت الإزالة من المفضلة');
                        }
                    })
                    .fail(function(xhr) {
                        if (xhr.status === 401) {
                            toastr.warning('يجب تسجيل الدخول أولاً');
                        } else {
                            toastr.error('حدث خطأ ما');
                        }
                    });
            });
        });

        var priceInputMax = document.getElementById('price-max'),
            priceInputMin = document.getElementById('price-min');

        priceInputMax.addEventListener('change', function() {
            document.getElementById('filter-form').submit();
        });
    </script>
@endpush
