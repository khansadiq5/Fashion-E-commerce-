<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->count() == 0) {
            return redirect('cart')->with('error', 'Your cart is empty.');
        }

        $grandTotal = 0;

        foreach ($cartItems as $item) {
            if (!$item->product || $item->product->status != 1) {
                return redirect('cart')->with('error', 'Some products are no longer available.');
            }

            if ($item->quantity > $item->product->stock) {
                return redirect('cart')->with('error', $item->product->name . ' has only ' . $item->product->stock . ' items available.');
            }

            $grandTotal += $item->product->getRawOriginal('price') * $item->quantity;
        }

        return view('checkout', [
            'cartItems' => $cartItems,
            'grandTotal' => $grandTotal,
        ]);
    }

    public function placeOrder(Request $req)
    {
        $req->validate([
            'full_name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required|min:10|max:15',
            'address' => 'required|min:5',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required|min:4|max:10',
            'payment_method' => 'required',
        ]);

        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->count() == 0) {
            return redirect('cart')->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();

        try {
            $grandTotal = 0;

            foreach ($cartItems as $item) {
                if (!$item->product || $item->product->status != 1) {
                    DB::rollBack();
                    return redirect('cart')->with('error', 'Some products are no longer available.');
                }

                if ($item->quantity > $item->product->stock) {
                    DB::rollBack();
                    return redirect('cart')->with('error', $item->product->name . ' has only ' . $item->product->stock . ' items available.');
                }

                $price = $item->product->getRawOriginal('price');
                $grandTotal += $price * $item->quantity;
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'VIORA-' . time() . '-' . Auth::id(),
                'full_name' => $req->full_name,
                'email' => $req->email,
                'phone' => $req->phone,
                'address' => $req->address,
                'city' => $req->city,
                'state' => $req->state,
                'pincode' => $req->pincode,
                'total_amount' => $grandTotal,
                'payment_method' => $req->payment_method,
                'payment_status' => 'pending',
                'order_status' => 'pending',
            ]);

            foreach ($cartItems as $item) {
                $product = Product::findOrFail($item->product_id);

                if ($item->quantity > $product->stock) {
                    DB::rollBack();
                    return redirect('cart')->with('error', $product->name . ' has only ' . $product->stock . ' items available.');
                }

                $price = $product->getRawOriginal('price');
                $subtotal = $price * $item->quantity;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_image' => $product->image,
                    'price' => $price,
                    'quantity' => $item->quantity,
                    'subtotal' => $subtotal,
                ]);

                $product->stock = $product->stock - $item->quantity;
                $product->save();
            }

            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            return redirect('order-success/' . $order->id)
                ->with('success', 'Order placed successfully.');

        } catch (\Exception $e) {
            DB::rollBack();

            dd($e->getMessage());

            return redirect('checkout')->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function orderSuccess($id)
    {
        $order = Order::with('items')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('order-success', [
            'order' => $order,
        ]);
    }
}