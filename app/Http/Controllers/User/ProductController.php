<?php

namespace App\Http\Controllers\User;

use App\Helper\Cart;
use Inertia\Inertia;
use App\Models\Brand;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Application;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'brand', 'product_images');
        $filterProducts = $products->filtered()->paginate(9)->withQueryString();

        $categories = Category::get();
        $brands = Brand::get();

        $cartData = Auth::user()? CartItem::where(['user_id' => Auth::user()->id])->get()->toJson() : Cart::getCookieCartItems();
        return Inertia::render(
            'User/ProductList',
            [
                'categories'=>$categories,
                'brands'=>$brands,
                'products' => $products,
                'canLogin' => app('router')->has('login'),
                'canRegister' => app('router')->has('register'),
                'laravelVersion' => Application::VERSION,
                'phpVersion' => PHP_VERSION,
                'auth' => Auth::user(),
                'cart' => $cartData,
            ]
        );
    }
}
