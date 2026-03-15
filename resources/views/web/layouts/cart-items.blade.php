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
            id="cart-total-price">${{ number_format($cartItems->sum(fn($c) => $c->product->price * $c->quantity), 2) }}</span>
    </div>

    <div class="cart-btns mt-3 d-flex justify-content-between">
        <a href="{{ route('carts.index') }}" class="btn btn-primary btn-sm w-100">
            {{ __('View Cart') }}
        </a>
    </div>
@endif
