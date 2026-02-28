@extends('web.layouts.app')

@section('content')

<style>
    /* الحاوية الأساسية */
.maintenance-wrapper {
    background-color: #f8fafc;
    padding: 40px 20px;
    min-height: 100vh;
}

.maintenance-form-card {
    max-width: 1200px;
    margin: 0 auto;
}

/* الهيدر */
.form-header {
    text-align: center;
    margin-bottom: 40px;
}

.form-header h1 {
    font-weight: 800;
    color: #1e293b;
    font-size: 2rem;
    margin-bottom: 10px;
}

.form-header p {
    color: #64748b;
}

/* شبكة الطلبات */
.orders-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 25px;
}

/* الكارت */
.order-card {
    background: #ffffff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    border: 1px solid #e2e8f0;
}

.order-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
}

/* الصورة والحالة العائمة */
.product-image-wrapper {
    position: relative;
    height: 200px;
}

.product-image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.floating-status {
    position: absolute;
    top: 15px;
    right: 15px;
    padding: 6px 14px;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 6px;
    backdrop-filter: blur(4px);
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

/* ألوان الحالات */
.status-pending { background: rgba(254, 243, 199, 0.9); color: #d97706; }
.status-delivering { background: rgba(219, 234, 254, 0.9); color: #2563eb; }
.status-done { background: rgba(220, 252, 231, 0.9); color: #16a34a; }

/* محتوى الكارت */
.order-card-body {
    padding: 20px;
    flex-grow: 1;
}

.product-title {
    display: block;
    font-size: 1.1rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 15px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* شبكة المعلومات (التاريخ والكمية) */
.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin-bottom: 20px;
}

.info-item {
    display: flex;
    flex-direction: column;
}

.info-label {
    font-size: 0.75rem;
    color: #94a3b8;
    text-transform: uppercase;
}

.info-value {
    font-size: 0.9rem;
    font-weight: 600;
    color: #334155;
}

/* شريط التقدم */
.mini-progress-bar {
    height: 6px;
    background: #f1f5f9;
    border-radius: 10px;
    margin-bottom: 15px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #3b82f6, #2563eb);
    border-radius: 10px;
    transition: width 0.5s ease-in-out;
}

/* الفوتر */
.order-footer {
    padding: 15px 20px;
    background: #f8fafc;
    border-top: 1px solid #e2e8f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.price-box {
    font-size: 1.25rem;
    font-weight: 800;
    color: #0f172a;
}

.price-box span {
    font-size: 0.8rem;
    color: #64748b;
    margin-right: 4px;
}

/* حالة لا توجد طلبات */
.empty-orders {
    grid-column: 1 / -1;
    text-align: center;
    padding: 60px;
    background: white;
    border-radius: 20px;
}

.empty-orders i {
    font-size: 4rem;
    color: #cbd5e1;
    margin-bottom: 20px;
}


/* حاوية الصورة */
.product-image-wrapper {
    position: relative;
    height: 220px; /* ارتفاع ثابت ومناسب */
    background-color: #f8fafc; /* خلفية فاتحة تظهر حدود المنتج */
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 15px;
    overflow: hidden;
}

.product-image-wrapper img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain; /* ده أهم سطر عشان الصورة متتمطش وتظهر كاملة */
    transition: transform 0.3s ease;
}

.order-card:hover .product-image-wrapper img {
    transform: scale(1.08); /* تأثير تكبير بسيط عند التمرير */
}

/* حالة الطلب العائمة (زي اللي في الصورة) */
.floating-status {
    position: absolute;
    top: 12px;
    right: 12px;
    z-index: 10;
    padding: 5px 12px;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 5px;
}

/* تنسيق الجدول الصغير للمعلومات */
.info-table {
    display: flex;
    width: 100%;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    margin: 15px 0;
    overflow: hidden;
}

.info-column {
    flex: 1;
    text-align: center;
    padding: 8px 5px;
    border-right: 1px solid #e2e8f0;
}

.info-column:last-child {
    border-right: none;
}

.info-column .label {
    display: block;
    font-size: 0.7rem;
    color: #94a3b8;
    margin-bottom: 2px;
}

.info-column .val {
    display: block;
    font-size: 0.85rem;
    font-weight: 700;
    color: #1e293b;
}

/* زر التفاصيل والسعر */
.order-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    background: #fdfdfd;
    border-top: 1px solid #f1f5f9;
}

.btn-details {
    background: #1e293b;
    color: white !important;
    padding: 8px 20px;
    border-radius: 50px;
    font-size: 0.85rem;
    text-decoration: none;
    transition: background 0.3s;
}

.btn-details:hover {
    background: #334155;
}
</style>
<div class="maintenance-wrapper">
    <div class="maintenance-form-card">

        <!-- Header -->
        <div class="form-header">
           <h1>{{ __('طلباتك') }}</h1>
        <p>{{ __('تتبع مشترياتك السابقة والحالية بكل سهولة') }}</p>
        </div>



  <div class="orders-grid">
    @forelse ($orders as $order)
        @foreach ($order->items as $item)
        <div class="order-card">
            <div class="product-image-wrapper">
                <div class="floating-status
                    @if($order->status == 4) status-done
                    @elseif($order->status == 3) status-delivering
                    @else status-pending @endif">

                    @if($order->status == 'pending') <i class="fas fa-clock"></i> {{ __('قيد الانتظار') }}
                    @elseif($order->status == 'delivery') <i class="fas fa-truck"></i> {{ __('يتم التوصيل') }}
                    @elseif($order->status == 'cancelled') <i class="fas fa-truck"></i> {{ __('يتم التوصيل') }}
                    @elseif($order->status == 'completed') <i class="fas fa-check-circle"></i> {{ __('مكتمل') }}
                    @endif
                </div>

                <img src="{{ asset($item->product->images->first()->image ?? 'default.png') }}" alt="product">
            </div>

            <div class="order-card-body">
                <h3 class="product-title">{{ $item->product->{'product_name_' . app()->getLocale()} }}</h3>

                <div class="info-table">
                    <div class="info-column">
                        <span class="label">{{ __('التاريخ') }}</span>
                        <span class="val">{{ $order->created_at->format('Y-m-d') }}</span>
                    </div>
                    <div class="info-column">
                        <span class="label">{{ __('الكمية') }}</span>
                        <span class="val">{{ $item->quantity }}</span>
                    </div>
                    <div class="info-column">
                        <span class="label">{{ __('الطلب #') }}</span>
                        <span class="val">{{ $order->id }}</span>
                    </div>
                </div>

                <div class="mini-progress-bar">
                    <div class="progress-fill" style="width: {{ $order->status == 'completed' ? '100' : ($order->status == 'delivery' ? '75' : '25') }}%"></div>
                </div>
            </div>

            <div class="order-footer">
                <div class="price-box">
                    {{ number_format($item->price, 0) }} <span>ج.م</span>
                </div>
                <a href="#" class="btn-details">
                    {{ __('التفاصيل') }}
                </a>
            </div>
        </div>
        @endforeach
    @empty
        @endforelse
</div>
</div>
</div>
@endsection
