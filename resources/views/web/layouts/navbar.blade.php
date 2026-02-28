<nav id="navigation" >
    <div class="container">
        <div id="responsive-nav">
            <ul class="main-nav nav navbar-nav">
                <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}">{{ __('Home') }}</a>
                </li>
                <li class="{{ request()->routeIs('maintenance') ? 'active' : '' }}">
                    <a href="{{ route('maintenance') }}">{{ __('Maintenance') }}</a>
                </li>
                <li class="{{ request()->is('sales') ? 'active' : '' }}">
                    <a href="{{ route('sales') }}">{{ __('Mobile phones for sale') }}</a>
                </li>
                @if (Auth::check())
                    <li>
                        <a href="{{ route('history_order.index') }}" class="text-decoration-none">{{ __('History Orders') }}</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
