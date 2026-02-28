@extends('web.layouts.app')

@section('content')
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- Product main img -->
                <div class="col-md-5 col-md-push-2">
                    <div id="product-main-img">
                        @foreach ($product->images as $image)
                            <div class="product-preview">
                                <img src="{{ asset($image->image) }}" alt="">
                            </div>
                        @endforeach


                    </div>
                </div>
                <!-- /Product main img -->

                <!-- Product thumb imgs -->
                <div class="col-md-2  col-md-pull-5">
                    <div id="product-imgs">
                        @foreach ($product->images as $image)
                            <div class="product-preview">
                                <img src="{{ asset($image->image) }}" alt="">
                            </div>
                        @endforeach





                    </div>
                </div>
                <!-- /Product thumb imgs -->

                <!-- Product details -->
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
                            <h3 class="product-price">${{ $product->discounted_price }} <del
                                    class="product-old-price">${{ $product->price }}</del></h3>
                            <span class="product-available">In Stock</span>
                        </div>
                        <p>{{ $product->description[app()->getLocale()] }}</p>



                        <div class="add-to-cart">
                            <div class="qty-label">
                                Qty
                                <div class="input-number">
                                    <input type="number" class="quantity-input" value="1" min="1">
                                    <span class="qty-up">+</span>
                                    <span class="qty-down">-</span>
                                </div>
                            </div>

                            <button class="add-to-cart-btn" data-product-id="{{ $product->id }}">
                                <i class="fa fa-shopping-cart"></i> add to cart
                            </button>



                        </div>

                        <ul class="product-btns">
                            {{--  <li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>  --}}
                            <li>
                                <a href="#" class="add-to-wishlist" data-product-id="{{ $product->id }}"
                                    data-toggle="tooltip" data-placement="top" title="Add To Favorite">

                                    <i class="fa fa-heart-o favorite-icon
            {{ $product->favorite && $product->favorite->favorite_type ? 'fas' : 'far' }}"
                                        style="font-size:16px;
           color: {{ $product->favorite && $product->favorite->favorite_type ? 'red' : 'inherit' }};">
                                    </i>
                                    add to wishlist
                                </a>
                            </li>

                            {{--  <li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>  --}}
                        </ul>

                        <ul class="product-links">
                            <li>Category:</li>
                            <li><a href="#">{{ $product->category->name[app()->getLocale()] }}</a></li>
                        </ul>

                        <ul class="product-links">
                            <li>Share:</li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                        </ul>

                    </div>
                </div>
                <!-- /Product details -->


            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- Section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h3 class="title">Related Products</h3>
                    </div>
                </div>
                @foreach ($relatedProducts as $relatedProduct)
                    <!-- product -->
                    <div class="col-md-3 col-xs-6">
                        <div class="product">
                            <div class="product-img">
                                <img src="{{ $relatedProduct->images->first()->image }}" alt="">
                                <div class="product-label">
                                    <span class="sale">-30%</span>
                                </div>
                            </div>
                            <div class="product-body">
                                <p class="product-category">{{ $relatedProduct->category->name[app()->getLocale()] }}</p>
                                <h3 class="product-name"><a
                                        href="{{ route('products.detail', $relatedProduct->id) }}">{{ $relatedProduct->name[app()->getLocale()] }}</a>
                                </h3>
                                <h4 class="product-price">${{ $relatedProduct->discounted_price }} <del
                                        class="product-old-price">${{ $relatedProduct->price }}</del></h4>
                                <div class="product-rating">
                                </div>
                                <div class="product-btns">
                                    {{--  <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add
                                            to wishlist</span></button>  --}}
                                              <button type="button" class="add-to-wishlist"
                                                                data-product-id="{{ $relatedProduct->id }}" data-toggle="tooltip"
                                                                data-placement="top" title="Add To Favorite">
                                                                <i class="fa fa-heart-o favorite-icon {{ $relatedProduct->favorite && $relatedProduct->favorite->favorite_type ? 'fas' : 'far' }}"
                                                                    style="font-size:18px; color: {{ $relatedProduct->favorite && $relatedProduct->favorite->favorite_type ? 'red' : 'inherit' }};"></i>
                                                            </button>
                                    {{--  <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add
                                            to compare</span></button>
                                    <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick
                                            view</span></button>  --}}
                                </div>
                            </div>
                            <div class="add-to-cart">
                                {{--  <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>  --}}
                                 <button class="add-to-cart-btn" data-product-id="{{ $product->id }}">
                                <i class="fa fa-shopping-cart"></i> add to cart
                            </button>

                            </div>
                        </div>
                    </div>
                    <!-- /product -->
                @endforeach




            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /Section -->

    <!-- NEWSLETTER -->
    <div id="newsletter" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="newsletter">
                        <p>Sign Up for the <strong>NEWSLETTER</strong></p>
                        <form>
                            <input class="input" type="email" placeholder="Enter Your Email">
                            <button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
                        </form>
                        <ul class="newsletter-follow">
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /NEWSLETTER -->
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            $(document).ready(function() {

                // زر +
                $(document).on('click', '.qty-up', function() {
                    let input = $(this).siblings('input');
                    input.val(parseInt(input.val()) + 1);
                });

                // زر -
                $(document).on('click', '.qty-down', function() {
                    let input = $(this).siblings('input');
                    let val = parseInt(input.val());
                    if (val > 1) input.val(val - 1);
                });

            });

            // إضافة للسلة
            $(document).on('click', '.add-to-cart-btn', function(e) {
                e.preventDefault();

                var button = $(this);
                var productId = button.data('product-id');

                var quantity = button.closest('.product')
                    .find('.quantity-input')
                    .val() || 1;

                $.post('{{ route('carts.store') }}', {
                        product_id: productId,
                        quantity: quantity
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
