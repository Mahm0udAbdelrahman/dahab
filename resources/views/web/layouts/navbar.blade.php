<nav id="navigation" >
    <div class="container">
        <div id="responsive-nav">
            <ul class="main-nav nav navbar-nav">
                <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}">{{ __('Home') }}</a>
                </li>
                <li class="{{ request()->routeIs('products.index') ? 'active' : '' }}">
                    <a href="{{ route('products.index') }}">{{ __('Products') }}</a>
                </li>
                <li class="{{ request()->routeIs('maintenance') ? 'active' : '' }}">
                    <a href="{{ route('maintenance') }}">{{ __('Maintenance') }}</a>
                </li>
                <li class="{{ request()->routeIs('sales') ? 'active' : '' }}">
                    <a href="{{ route('sales') }}">{{ __('Mobile phones for sale') }}</a>
                </li>

                @if (Auth::check())
                    <li>
                        <a href="{{ route('history_order.index') }}" class="text-decoration-none">{{ __('History Orders') }}</a>
                    </li>
                @endif

                <!-- Mobile only: Language & Account -->
                <li class="divider visible-xs visible-sm" style="border-top: 1px solid #333; margin: 10px 0;"></li>
                
                <li class="dropdown visible-xs visible-sm">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-globe"></i> {{ __('Language') }} ({{ app()->getLocale() }}) <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu" style="background: #1e1f29; border: none;">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <a href="{{ LaravelLocalization::getLocalizedURL($localeCode) }}" 
                                   style="color: {{ app()->getLocale() == $localeCode ? '#d10024' : '#fff' }}; padding: 10px 20px;">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <li class="dropdown visible-xs visible-sm">
                    @auth
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user-o"></i> {{ auth()->user()->name }} <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu" style="background: #1e1f29; border: none;">
                            <li>
                                <a href="{{ route('logout') }}" 
                                   onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
                                   style="color: #fff; padding: 10px 20px;">
                                    <i class="fa fa-sign-out"></i> {{ __('Logout') }}
                                </a>
                                <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    @else
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user-o"></i> {{ __('Account') }} <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu" style="background: #1e1f29; border: none;">
                            <li>
                                <a href="{{ route('login') }}" style="color: #fff; padding: 10px 20px;">
                                    <i class="fa fa-sign-in"></i> {{ __('Login') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}" style="color: #fff; padding: 10px 20px;">
                                    <i class="fa fa-user-plus"></i> {{ __('Register') }}
                                </a>
                            </li>
                        </ul>
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>
