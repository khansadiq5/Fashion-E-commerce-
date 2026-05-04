<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\Cart;

class UserController extends Controller
{
    public function home()
    {
        $categories = Categorie::where('status', 1)->latest()->get();

        $products = Product::where('status', 1)
            ->latest()
            ->take(8)
            ->get();

        return view('dashboard', [
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function allCollection(Request $req)
    {
        $categories = Categorie::where('status', 1)->latest()->get();

        $selectedCategories = $req->input('category_id', []);
        if (!is_array($selectedCategories)) {
            $selectedCategories = [$selectedCategories];
        }

        $selectedCategories = array_filter($selectedCategories);

        $minPrice = $req->input('min_price');
        $maxPrice = $req->input('max_price');

        $products = Product::where('status', 1);

        if ($req->filled('search')) {
            $products->where('name', 'like', '%' . $req->search . '%');
        }

        if (!empty($selectedCategories)) {
            $products->whereIn('category_id', $selectedCategories);
        }

        if ($minPrice !== null && $minPrice !== '') {
            $products->whereRaw('CAST(price AS DECIMAL(10,2)) >= ?', [(float) $minPrice]);
        }

        if ($maxPrice !== null && $maxPrice !== '') {
            $products->whereRaw('CAST(price AS DECIMAL(10,2)) <= ?', [(float) $maxPrice]);
        }

        if ($req->sort == 'latest') {
            $products->latest();
        } elseif ($req->sort == 'low_high') {
            $products->orderByRaw('CAST(price AS DECIMAL(10,2)) ASC');
        } elseif ($req->sort == 'high_low') {
            $products->orderByRaw('CAST(price AS DECIMAL(10,2)) DESC');
        } else {
            $products->latest();
        }

        $products = $products->paginate(12)->appends($req->query());

        return view('collection', [
            'products' => $products,
            'categories' => $categories,
            'search' => $req->search,
            'category_id' => $selectedCategories,
            'min_price' => $minPrice,
            'max_price' => $maxPrice,
            'sort' => $req->sort,
        ]);
    }

    public function productDetail($id)
    {
        $product = Product::where('status', 1)->findOrFail($id);

        $relatedProducts = Product::where('status', 1)
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(8)
            ->get();

        return view('product-detail', ['product' => $product,'relatedProducts' => $relatedProducts]);
    }

    //Cart
    public function addToCart(Request $req, $id)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $product = Product::where('status', 1)->findOrFail($id);

        $req->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $quantity = (int) $req->quantity;

        if ($product->stock < $quantity) {
            return back()->with('error', 'Only '.$product->stock.' items available in stock.');
        }

        $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($cart) {
            $newQuantity = $cart->quantity + $quantity;

            if ($newQuantity > $product->stock) {
                return back()->with('error', 'You cannot add more than available stock.');
            }

            $cart->quantity = $newQuantity;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }

        return redirect('cart');
    }

    public function cart()
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $grandTotal = 0;

        foreach ($cartItems as $item) {
            if ($item->product) {
                $grandTotal += $item->product->getRawOriginal('price') * $item->quantity;
            }
        }

        return view('cart', [
            'cartItems' => $cartItems,
            'grandTotal' => $grandTotal,
        ]);
    }

    public function updateQuantity(Request $req, $id)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $req->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::with('product')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        if ($req->quantity > $cart->product->stock) {
            return back()->with('error', 'Only '.$cart->product->stock.' items available in stock.');
        }

        $cart->quantity = $req->quantity;
        $cart->save();

        return back()->with('success', 'Cart quantity updated.');
    }

    public function removeItem($id)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $cart = Cart::where('user_id', Auth::id())->findOrFail($id);
        $cart->delete();

        return back()->with('success', 'Product removed from cart.');
    }
}