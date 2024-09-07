<?php

namespace App\Http\Controllers;

use App\Helper\Cart;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Application;


class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('brand', 'category', 'product_images')->orderBy('id','desc')->limit(8)->get();
        $cartData = Auth::user()? CartItem::where(['user_id' => Auth::user()->id])->get()->toJson() : Cart::getCookieCartItems();
        return Inertia::render('User/Index', [
            'products'=>$products,
            'canLogin' => app('router')->has('login'),
            'canRegister' => app('router')->has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'auth' => Auth::user(),
            'cart' => $cartData,
        ]);
    }
}
