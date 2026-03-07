<?php
namespace App\Services\Web;

use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Notifications\DashboardNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class OrderService
{

    public function cashOrder($data)
    {
        $user = auth()->user();

        $cartItems = Cart::where('user_id', $user->id)->get();

        $order = Order::create([
            'user_id'        => $user->id,
            'total'          => $cartItems->sum(function ($item) {
                return $item->price * $item->quantity;
            }),
            'name'           => $data['name'],
            'address'        => $data['address'],
            'payment_status' => $data['payment_status'],
            'phone'          => $data['phone'],
            'status'         => 'pending',
        ]);

        foreach ($cartItems as $item) {
            $order->items()->updateOrCreate(
                ['order_id' => $order->id, 'product_id' => $item->product_id],
                [
                    'quantity' => $item->quantity,
                    'price'    => $item->price,
                    'total'    => $item->price * $item->quantity,
                ]
            );
            if ($item->product) {
                $item->product->decrement('amount_in_stock', $item->quantity);
            }
        }
        Cart::where('user_id', $user->id)->delete();
        $admins = User::whereHas('roles', fn($q) => $q->where('name', 'admin'))->get();

        Notification::send(
            $admins,
            new DashboardNotification(
                $order->id,
                $order->user->name,
                $order->total,
                'order'
            )
        );
        Session::flash('message', ['type' => 'success', 'text' => __('تم إنشاء الطلب بنجاح')]);
        return redirect()->route('carts.index')->with('success', 'تم إنشاء الطلب بنجاح');
    }

}
