<header>
    <div id="top-header">
        <div class="container d-flex justify-content-between align-items-center">
            <ul class="header-links d-flex gap-3 mb-0">
                <li>
                    <a href="https://wa.me/2{{ $setting->phone }}" target="_blank" class="d-flex align-items-center gap-1">
                        <i class="fa fa-phone"></i> {{ $setting->phone }}
                    </a>
                </li>
                <li>
                    <a href="mailto:{{ $setting->email }}" class="d-flex align-items-center gap-1">
                        <i class="fa fa-envelope-o"></i> {{ $setting->email }}
                    </a>
                </li>
                <li class="d-flex align-items-center gap-1">
                    <i class="fa fa-map-marker"></i>
                    {{ $setting->address[app()->getLocale()] }}
                </li>
            </ul>

            <ul class="header-links mb-0">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user-o"></i>
                        {{ auth()->check() ? auth()->user()->name : __('Account') }}
                    </a>
                    <ul class="dropdown-menu">
                        @auth
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        @endauth
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div id="header">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-md-3">
                    <a href="{{ route('home') }}" class="logo d-block">
                        <img src="{{ asset('web/img/logo_two.png') }}" height="80" alt="Logo">
                    </a>
                </div>

                <div class="col-md-6">
                    <div class="header-search">
                        <form action="{{ route('home') }}#products-section" method="GET"
                            class="search-form d-flex align-items-center gap-2">
                            <select name="category_id" class="form-select category-select">
                                <option value="0">{{ __('All Categories') }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name[app()->getLocale()] }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="text" name="query" class="form-control search-input"
                                placeholder="{{ __('Search here') }}" value="{{ request('query') }}">
                            <button class="btn btn-danger search-btn" type="submit">{{ __('Search') }}</button>
                        </form>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="header-ctn d-flex justify-content-end align-items-center gap-4">

                        <div class="dropdown lang-dropdown">
                            <a class="dropdown-toggle lang-toggle d-flex align-items-center gap-1"
                                data-toggle="dropdown" href="#">
                                <i class="fa fa-globe"></i>
                                <span class="lang-text text-uppercase">{{ app()->getLocale() }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right lang-menu p-0 mt-2 shadow rounded">
                                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <a href="{{ LaravelLocalization::getLocalizedURL($localeCode) }}"
                                        class="dropdown-item lang-item d-flex justify-content-between align-items-center px-3 py-2 {{ app()->getLocale() == $localeCode ? 'active fw-bold text-danger' : '' }}">
                                        <span>{{ $properties['native'] }}</span>
                                        @if (app()->getLocale() == $localeCode)
                                            <i class="fa fa-check text-danger"></i>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <a href="{{ route('favorites.index') }}"
                                class="d-flex align-items-center gap-1 text-decoration-none text-dark">
                                <i class="fa fa-heart-o fa-lg"></i>
                                <span>{{ __('Wishlist') }}</span>
                                <div id="wishlist-count" class="qty badge bg-danger rounded-circle text-white">
                                    {{ $favoriteCount }}</div>
                            </a>
                        </div>

                        <div class="dropdown" id="cart-dropdown-container">
                            <a class="dropdown-toggle d-flex align-items-center gap-1 position-relative text-decoration-none text-dark"
                                data-toggle="dropdown" href="#">
                                <i class="fa fa-shopping-cart fa-lg"></i>
                                <span>{{ __('Cart') }}</span>
                                <div id="cart-count"
                                    class="qty badge bg-danger rounded-circle text-white position-absolute top-0 start-100 translate-middle">
                                    {{ $cartCount }}</div>
                            </a>

                            <div class="cart-dropdown dropdown-menu dropdown-menu-right p-3 shadow rounded"
                                style="min-width: 320px; max-height: 450px; overflow-y: auto;">
                                <div id="cart-content-wrapper">
                                    <h5 class="mb-3">{{ __('Cart Items') }} (<span
                                            class="js-cart-count">{{ $cartCount }}</span>)</h5>

                                    <ul class="cart-items-list list-unstyled mb-3">
                                        @forelse ($cartItems as $cart)
                                            <li class="mb-3 d-flex align-items-center gap-3 cart-item-row"
                                                data-id="{{ $cart->id }}">
                                                <img src="{{ asset($cart->product->images->first()->image ?? 'default.png') }}"
                                                    alt="product"
                                                    style="width: 60px; height: 60px; object-fit: cover;">
                                                <div class="flex-grow-1">
                                                    <strong>{{ $cart->product->{'product_name_' . app()->getLocale()} }}</strong>
                                                    <div>${{ number_format($cart->product->price, 2) }}</div>
                                                </div>
                                                 <form action="{{ route('carts.destroy', $cart->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-link p-0 text-danger remove-from-cart">
                                                 <i class="fa fa-close"></i>
                                            </button>
                                        </form>
                                            </li>
                                        @empty
                                            <li class="text-center text-muted py-4">
                                                <i class="fa fa-shopping-cart fa-2x mb-2"></i>
                                                <div>{{ __('Cart is empty') }}</div>
                                            </li>
                                        @endforelse
                                    </ul>

                                    @if ($cartCount > 0)
                                        <div
                                            class="cart-summary d-flex justify-content-between fw-bold border-top pt-2">
                                            <small><span class="js-cart-count">{{ $cartCount }}</span>
                                                {{ __('items') }}</small>
                                            <span
                                                id="cart-total-price">${{ number_format($cartItems->sum(fn($c) => $c->product->price), 2) }}</span>
                                        </div>

                                        <div class="cart-btns mt-3 d-flex justify-content-between">
                                            <a href="{{ route('carts.index') }}" class="btn btn-primary btn-sm w-100">
                                                {{ __('View Cart') }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="menu-toggle d-md-none d-block">
                            <a href="#"><i class="fa fa-bars fa-lg"></i></a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</header>

