@extends('dashboard.layouts.app')
@section('title', __('Order Details'))

@section('content')
<div class="pc-container">
    <div class="pc-content">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>{{ __('Order Information') }} #{{ $order->id }}</h5>
                <a href="{{ route('Admin.orders.index') }}" class="btn btn-secondary btn-sm">{{ __('Back') }}</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-primary border-bottom pb-2">{{ __('Customer Details') }}</h6>
                        <table class="table table-borderless">
                            <tr><th>{{ __('Name') }}:</th><td>{{ $order->name }}</td></tr>
                            <tr><th>{{ __('Phone') }}:</th><td>{{ $order->phone }}</td></tr>
                            <tr><th>{{ __('Address') }}:</th><td>{{ $order->address }}</td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-primary border-bottom pb-2">{{ __('Payment & Status') }}</h6>
                        <table class="table table-borderless">
                            <tr><th>{{ __('Payment Status') }}:</th><td><span class="badge bg-light-secondary">{{ __($order->payment_status) }}</span></td></tr>
                            <tr><th>{{ __('Order Status') }}:</th><td><span class="badge bg-info">{{ __($order->status) }}</span></td></tr>
                            <tr><th>{{ __('Date') }}:</th><td>{{ $order->created_at->format('Y-m-d H:i') }}</td></tr>
                            <tr>
                                <th>{{ __('wasl') }}:</th>
                                <td>
                                    @if ($order->wasl)
                                        <div class="mt-1">
                                            <img src="{{ asset($order->wasl) }}" alt="wasl"
                                                class="img-fluid rounded shadow-sm mb-2 d-block" style="max-height: 150px;">
                                            <div class="d-flex gap-2">
                                                <a href="{{ asset($order->wasl) }}" target="_blank"
                                                    class="btn btn-sm btn-info">
                                                    <i class="ti ti-eye"></i> {{ __('View') }}
                                                </a>
                                                <a href="{{ asset($order->wasl) }}" download="wasl_{{ $order->id }}"
                                                    class="btn btn-sm btn-success">
                                                    <i class="ti ti-download"></i> {{ __('Download') }}
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-muted">{{ __('No receipt uploaded') }}</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h5>{{ __('Order Items') }}</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-light">
                                <th>#</th>
                                <th>{{ __('Product') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Quantity') }}</th>
                                <th>{{ __('Total') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{-- نفترض أن اسم المنتج مخزن بـ JSON للغات --}}
                                    {{ $item->product->name[app()->getLocale()] ?? $item->product->name }}
                                </td>
                                <td>{{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->total, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-end">{{ __('Grand Total') }}:</th>
                                <th><h5 class="m-0 text-success">{{ number_format($order->total, 2) }}</h5></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
