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

            <ul class="header-links mb-0 hidden-xs">
                <li><i class="fa fa-clock-o"></i> 24/7 Support</li>
            </ul>
        </div>
    </div>
    <div id="header">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-md-3 col-xs-4">
                    <a href="{{ route('home') }}" class="logo d-block">
                        <img src="{{ asset('web/img/logo_two.png') }}" height="80" alt="Logo">
                    </a>
                </div>

                <div class="col-md-5 col-xs-12">
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

                <div class="col-md-4 col-xs-8">
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

                        <div class="dropdown account-dropdown">
                            <a class="dropdown-toggle d-flex align-items-center gap-1 text-decoration-none"
                                data-toggle="dropdown" href="#">
                                <i class="fa fa-user-o fa-lg"></i>
                                <span class="hidden-xs text-white">{{ auth()->check() ? explode(' ', auth()->user()->name)[0] : __('Login') }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right account-menu p-0 mt-2 shadow rounded">
                                @auth
                                    <div class="px-3 py-2 border-bottom bg-light">
                                        <small class="text-muted">{{ __('Welcome') }},</small>
                                        <div class="fw-bold text-truncate">{{ auth()->user()->name }}</div>
                                    </div>
                                    <li>
                                        <a href="{{ route('logout') }}" class="dropdown-item px-3 py-2"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out me-2"></i> {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                @else
                                    <a href="{{ route('login') }}" class="dropdown-item px-3 py-2">
                                        <i class="fa fa-sign-in me-2"></i> {{ __('Login') }}
                                    </a>
                                    <a href="{{ route('register') }}" class="dropdown-item px-3 py-2">
                                        <i class="fa fa-user-plus me-2"></i> {{ __('Register') }}
                                    </a>
                                @endauth
                            </div>
                        </div>

                        <div>
                            <a href="{{ route('favorites.index') }}"
                                class="d-flex align-items-center gap-1 text-decoration-none">
                                <i class="fa fa-heart-o fa-lg"></i>
                                <span class="hidden-xs text-white">{{ __('Wishlist') }}</span>
                                <div id="wishlist-count" class="qty">
                                    {{ $favoriteCount }}</div>
                            </a>
                        </div>

                        <div class="dropdown" id="cart-dropdown-container">
                            <a class="dropdown-toggle d-flex align-items-center gap-1 position-relative text-decoration-none"
                                data-toggle="dropdown" href="#">
                                <i class="fa fa-shopping-cart fa-lg"></i>
                                <span class="hidden-xs text-white">{{ __('Cart') }}</span>
                                <div id="cart-count"
                                    class="qty">
                                    {{ $cartCount }}</div>
                            </a>

                            <div class="cart-dropdown dropdown-menu dropdown-menu-right p-3 shadow rounded"
                                style="min-width: 320px; max-height: 450px; overflow-y: auto;">
                                <div id="cart-content-wrapper">
                                    @include('web.layouts.cart-items')
                                </div>
                            </div>
                        </div>

                        <div class="menu-toggle visible-xs visible-sm">
                            <a href="#"><i class="fa fa-bars fa-lg"></i></a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</header>

