@extends('web.layouts.app')

@section('content')

<style>
/* الحاوية الأساسية */
.my-orders-section {
    background-color: #f1f5f9;
    padding: 60px 0;
    min-height: 80vh;
}

/* الهيدر */
.orders-header {
    text-align: center;
    margin-bottom: 50px;
}

.orders-header h1 {
    font-weight: 800;
    color: #0f172a;
    font-size: 2.5rem;
    margin-bottom: 10px;
}

.orders-header p {
    color: #64748b;
    font-size: 1.1rem;
}

/* شبكة الطلبات */
.orders-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 30px;
}

/* الكارت */
.order-card {
    background: #ffffff;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    flex-direction: column;
    border: 1px solid rgba(226, 232, 240, 0.8);
}

.order-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
}

/* الصورة والحالة */
.order-image-box {
    position: relative;
    height: 240px;
    background-color: #f8fafc;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.order-image-box img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    transition: transform 0.5s ease;
}

.order-card:hover .order-image-box img {
    transform: scale(1.1);
}

/* الأوسمة العائمة */
.status-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    z-index: 10;
    padding: 6px 16px;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 800;
    display: flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.status-completed { background: #dcfce7; color: #15803d; }
.status-delivery { background: #dbeafe; color: #1d4ed8; }
.status-pending { background: #fef3c7; color: #b45309; }
.status-cancelled { background: #fee2e2; color: #b91c1c; }

/* محتوى الكارت */
.order-card-body {
    padding: 25px;
}

.order-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 15px;
    display: block;
    text-decoration: none;
}

/* جدول البيانات */
.order-meta-table {
    display: flex;
    background: #f8fafc;
    border-radius: 16px;
    margin-bottom: 20px;
    padding: 10px 0;
}

.meta-item {
    flex: 1;
    text-align: center;
    border-right: 1px solid #e2e8f0;
}

.meta-item:last-child { border-right: none; }

.meta-label {
    display: block;
    font-size: 0.7rem;
    color: #94a3b8;
    text-transform: uppercase;
    margin-bottom: 4px;
}

.meta-value {
    display: block;
    font-size: 0.9rem;
    font-weight: 700;
    color: #334155;
}

/* شريط التقدم */
.order-progress-container {
    margin-bottom: 10px;
}

.progress-label {
    display: flex;
    justify-content: space-between;
    font-size: 0.8rem;
    margin-bottom: 8px;
    font-weight: 600;
}

.mini-bar {
    height: 8px;
    background: #e2e8f0;
    border-radius: 10px;
    overflow: hidden;
}

.bar-fill {
    height: 100%;
    background: linear-gradient(90deg, #D10024, #ff4d4d); /* Electro Red Gradient */
    transition: width 1s ease-in-out;
}

/* الفوتر والسعر */
.order-card-footer {
    padding: 20px 25px;
    background: #fafafa;
    border-top: 1px solid #f1f5f9;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.order-price {
    font-size: 1.4rem;
    font-weight: 900;
    color: #D10024;
}

.order-price span {
    font-size: 0.85rem;
    color: #64748b;
    margin-left: 3px;
}

.btn-view-order {
    background: #1e293b;
    color: #fff !important;
    padding: 10px 24px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s;
}

.btn-view-order:hover {
    background: #000;
    transform: scale(1.05);
}

/* حالة لا توجد طلبات */
.no-orders {
    grid-column: 1 / -1;
    text-align: center;
    background: #fff;
    padding: 80px;
    border-radius: 30px;
}

.no-orders i {
    font-size: 5rem;
    color: #e2e8f0;
    margin-bottom: 20px;
}
</style>

<div class="my-orders-section">
    <div class="container">

        <div class="orders-header">
            <h1>{{ __('My Orders') }}</h1>
            <p>{{ __('Track and manage your recent and past purchases') }}</p>
        </div>

        <div class="orders-grid">
            @forelse ($orders as $order)
                @foreach ($order->items as $item)
                <div class="order-card">
                    <div class="order-image-box">
                        <div class="status-badge
                            @if($order->status == 'completed') status-completed
                            @elseif($order->status == 'delivery') status-delivery
                            @elseif($order->status == 'cancelled') status-cancelled
                            @else status-pending @endif">

                            @if($order->status == 'pending') <i class="fas fa-clock"></i> {{ __('Pending') }}
                            @elseif($order->status == 'delivery') <i class="fas fa-truck"></i> {{ __('Delivering') }}
                            @elseif($order->status == 'completed') <i class="fas fa-check-circle"></i> {{ __('Completed') }}
                            @elseif($order->status == 'cancelled') <i class="fas fa-times-circle"></i> {{ __('Cancelled') }}
                            @endif
                        </div>
                        <img src="{{ asset($item->product->images->first()->image ?? 'img/default.png') }}" alt="product">
                    </div>

                    <div class="order-card-body">
                        <a href="{{ route('products.detail', $item->product_id) }}" class="order-title">
                            {{ $item->product->name[app()->getLocale()] ?? $item->product->name }}
                        </a>

                        <div class="order-meta-table">
                            <div class="meta-item">
                                <span class="meta-label">{{ __('Date') }}</span>
                                <span class="meta-value">{{ $order->created_at->format('d M, Y') }}</span>
                            </div>
                            <div class="meta-item">
                                <span class="meta-label">{{ __('Qty') }}</span>
                                <span class="meta-value">{{ $item->quantity }}</span>
                            </div>
                            <div class="meta-item">
                                <span class="meta-label">{{ __('Order ID') }}</span>
                                <span class="meta-value">#{{ $order->id }}</span>
                            </div>
                        </div>

                        <div class="order-progress-container">
                            <div class="progress-label">
                                <span>{{ __('Status Progress') }}</span>
                                <span>
                                    @if($order->status == 'completed') 100%
                                    @elseif($order->status == 'delivery') 75%
                                    @elseif($order->status == 'cancelled') 0%
                                    @else 25% @endif
                                </span>
                            </div>
                            <div class="mini-bar">
                                <div class="bar-fill" style="width: {{ $order->status == 'completed' ? '100' : ($order->status == 'delivery' ? '75' : ($order->status == 'cancelled' ? '0' : '25')) }}%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="order-card-footer">
                        <div class="order-price">
                            {{ number_format($item->price, 0) }} <span>{{ __('EGP') }}</span>
                        </div>
                        <a href="#" class="btn-view-order">
                            {{ __('Details') }}
                        </a>
                    </div>
                </div>
                @endforeach
            @empty
                <div class="no-orders">
                    <i class="fas fa-shopping-bag"></i>
                    <h2>{{ __('No orders found') }}</h2>
                    <p>{{ __('Looks like you haven\'t made any orders yet.') }}</p>
                    <a href="{{ url('/') }}" class="primary-btn mt-3">{{ __('Start Shopping') }}</a>
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection
