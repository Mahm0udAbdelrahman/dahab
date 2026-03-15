<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CartRepository $cart)
    {
        $items = Cart::get();
        $items = $cart->get();
        $total = Cart::join('products', 'products.id', '=', 'carts.product_id')
            ->where('carts.user_id', auth()->user()->id)
            ->selectRaw('SUM(products.price * carts.quantity) as total')
            ->value('total');
        return view('web.pages.cart', compact('items', 'total'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CartRepository $cart)
    {
        $request->validate([
            'product_id' => ['required', 'int', 'exists:products,id'],
            'quantity'   => ['nullable', 'int', 'min:1'],
        ]);
        $product = Product::findOrFail($request->product_id);
        $cart->add($product, $request->quantity ?? 1);

        $cart_product = Cart::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->first();
        $cart_product->update([
            'price' => $product->price,
            'total' => $product->price * $request->quantity ?? 1,
        ]);

        if ($request->ajax()) {
            $cartItems = Cart::with('product.images')->where('user_id', auth()->id())->get();
            $cartCount = $cartItems->count();
            return response()->json([
                'status' => 'success',
                'message' => 'تم إضافة المنتج إلى السلة',
                'cart_count' => $cartCount,
                'cart_html' => view('web.layouts.cart-items', compact('cartItems', 'cartCount'))->render()
            ]);
        }

        return to_route('carts.index');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CartRepository $cart)
    {
        $request->validate([
            'product_id' => ['required', 'int', 'exists:products,id'],
            'quantity'   => ['nullable', 'int', 'min:1'],
        ]);
        $product = Product::findOrFail($request->product_id);

        $cart->update($product, $request->quantity);

        return to_route('carts.index');
    }

    public function update_carts(Request $request, CartRepository $cart)
    {
        $id = request('id');

        $request->validate([
            'quantity' => ['nullable', 'int', 'min:1'],
        ]);
        $cart           = Cart::where('id', $id)->first();
        $product        = Product::findOrFail($cart->product_id);
        $quantity       = $request->quantity;
        $cart->quantity = $quantity;
        $cart->total    = $quantity * $cart->product->price;

        $cart->save();
        $cart->update(['quantity' => $request->quantity]);
        return response()->json([
            'message' => 'Cart updated successfully',
            'status'  => 200,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartRepository $cart, $id)
    {
        $cart->delete($id);
        return to_route('carts.index')->with('success', 'Item removed from cart successfully');
    }

    // public function total(CartRepository $cart)
    // {
    //      $cart->total();

    //  }

    public function getTotal()
    {
        $total = Cart::join('products', 'products.id', '=', 'carts.product_id')
            ->where('carts.user_id', auth()->id())
            ->selectRaw('SUM(products.price * carts.quantity) as total')
            ->value('total') ?? 0;

        return response()->json([
            'total' => number_format($total, 2),
        ]);
    }

    public function flush(CartRepository $cart)
    {
        $cart->flush();
        return to_route('carts.index')->with('success', 'Item removed from cart successfully');

    }

}
