<?php
namespace App\Providers;

use App\Models\Cart;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Repositories\Cart\CartRepository::class, \App\Repositories\Cart\CartModelRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $cartCount     = 0;
            $favoriteCount = 0;
            $cartItems     = collect();

            if (auth()->check()) {
                $cartCount     = Cart::where('user_id', auth()->id())->count();
                $favoriteCount = Favorite::where('user_id', auth()->id())->count();
                $cartItems     = Cart::with('product.images')
                    ->where('user_id', auth()->id())
                    ->get();
            }

            $view->with(compact('cartCount', 'favoriteCount', 'cartItems'));
        });

        View::composer('web.layouts.header', function ($view) {
        $view->with([
            'setting'    => Setting::first(),
            'categories' => Category::active()->get(),
        ]);
    });
    }
}
