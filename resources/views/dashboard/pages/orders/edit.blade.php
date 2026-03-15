@extends('dashboard.layouts.app')
@section('title', __('Edit Order'))

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <form action="{{ route('Admin.orders.update', $order) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-header">
                                <h5>{{ __('Order Management') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Order Status') }}</label>
                                    <select name="status" class="form-select">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                            {{ __('Pending') }}</option>
                                        <option value="delivery" {{ $order->status == 'delivery' ? 'selected' : '' }}>
                                            {{ __('Delivery') }}</option>
                                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>
                                            {{ __('Completed') }}</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                                            {{ __('Cancelled') }}</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Payment Status') }}</label>
                                    <select name="payment_status" class="form-select">
                                        <option value="cash" {{ $order->payment_status == 'cash' ? 'selected' : '' }}>
                                            Cash</option>
                                        <option value="instapay"
                                            {{ $order->payment_status == 'instapay' ? 'selected' : '' }}>Instapay</option>
                                        <option value="vodafonecash"
                                            {{ $order->payment_status == 'vodafonecash' ? 'selected' : '' }}>Vodafone Cash
                                        </option>
                                    </select>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Customer Name') }}</label>
                                    <input type="text" name="name" class="form-control" value="{{ $order->name }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Phone') }}</label>
                                    <input type="text" name="phone" class="form-control" value="{{ $order->phone }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Address') }}</label>
                                    <textarea name="address" class="form-control" rows="3">{{ $order->address }}</textarea>
                                </div>
                                //wasl
                                <div class="mb-3">
                                    <label class="form-label">{{ __('wasl') }}</label>
                                     <input type="file" name="wasl" class="form-control" value="{{ $order->wasl }}">
                                     <img src="{{ asset($order->phone) }}" alt="">
                                </div>
                                <button type="submit" class="btn btn-primary w-100">{{ __('Save Changes') }}</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-header">
                                <h5>{{ __('Items in Order') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>{{ __('Product') }}</th>
                                                <th>{{ __('Price') }}</th>
                                                <th>{{ __('Qty') }}</th>
                                                <th>{{ __('Total') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->items as $item)
                                                <tr>
                                                    <td>{{ $item->product->name[app()->getLocale()] ?? $item->product->name }}
                                                    </td>
                                                    <td>{{ $item->price }}</td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>{{ $item->total }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
