<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    function dashboard()
    {
        $productsCount = Product::count();
        $categoriesCount = Categorie::count();

        $inStock = Product::where('stock', '>', 0)->count();
        $outStock = Product::where('stock', '<=', 0)->count();

        $ordersCount = Order::count();
        $pendingOrders = Order::where('order_status', 'pending')->count();

        $totalRevenue = Order::where('order_status', '!=', 'cancelled')->sum('total_amount');

        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin', [
            'productsCount' => $productsCount,
            'categoriesCount' => $categoriesCount,
            'inStock' => $inStock,
            'outStock' => $outStock,
            'ordersCount' => $ordersCount,
            'pendingOrders' => $pendingOrders,
            'totalRevenue' => $totalRevenue,
            'recentOrders' => $recentOrders,
        ]);
    }

    function addCategory(Request $req){
        $req->validate([
        'name' => 'required|min:3|unique:categories,name',
        'description' => 'nullable',
        'status' => 'required',
    ]);
        $isAdded = new Categorie;
        $isAdded->name = $req->name;
        $isAdded->slug = Str::slug($req->name);
        $isAdded->description = $req->description;
        $isAdded->status = $req->status;
        $isAdded->save();

        if($isAdded){
            return redirect(url('admin/category'));
        }else {
            return "Something wrong";
        }
    }

    function category(Request $req){
        $isData = Categorie::paginate(6);
        return view('category',['categories'=>$isData]);
    }

    function showEditCategory($id)
    {
        $isEdit = Categorie::findOrFail($id);
        return view('edit-category', ['category' => $isEdit]);
    }

    function editCategory(Request $req, $id){
        $req->validate([
        'name' => 'required|min:3|unique:categories,name,' . $id,
        'description' => 'nullable',
        'status' => 'required',
    ]);
        $isEdit = Categorie::findOrFail($id);
        $isEdit->name = $req->name;
        $isEdit->slug = Str::slug($req->name);
        $isEdit->description = $req->description;
        $isEdit->status = $req->status;
        $isEdit->save();

        if($isEdit){
            return redirect(url('admin/category'));
        }else {
            return "Something was wrong";
        }

    }

    function deleteCategory($id){
        $isDeleted = Categorie::destroy($id);

        if($isDeleted){
            return redirect(url('admin/category'));
        }else{
            return "something was wrong!";
        }
    }

    // Product

    function showAddProduct()
    {
        $isData = Categorie::where('status', 1)->get();
        return view('add-product', ['categories' => $isData]);
    }

    function addProduct(Request $req){
        $req->validate([
        'name' => 'required|min:3',
        'short_description' => 'nullable|max:255',
        'description' => 'nullable',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'category_id' => 'required',
        'status' => 'required',
        'image' => 'required|image',
    ]);
        $isAdded = new Product;
        $isAdded->name = $req->name;
        $isAdded->slug = Str::slug($req->name);
        $isAdded->short_description = $req->short_description;
        $isAdded->description = $req->description;
        $isAdded->price = $req->price;
        $isAdded->status = $req->status;
        $isAdded->stock = $req->stock;
        $isAdded->category_id = $req->category_id;

        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('uploads/products'), $imageName);
            $isAdded->image = $imageName;
        }
        $isAdded->save();
        if($isAdded){
            return redirect(url('admin/product'));
        }else {
            return "something Wrong!";
        }
        
    }

    function product(){
        $isData = Product::paginate(5);
        return view('product', ['products' => $isData]);
    }

    function showEditProduct($id)
    {
        $isEdit = Product::findOrFail($id);
        $categories = Categorie::where('status', 1)->get();

        return view('edit-product', [
            'product' => $isEdit,
            'categories' => $categories
        ]);
    }

    function editProduct(Request $req, $id)
    {
        $req->validate([
            'name' => 'required|min:3',
            'short_description' => 'nullable|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required',
            'status' => 'required',
            'image' => 'nullable|image',
        ]);

        $isEdit = Product::findOrFail($id);

        $isEdit->name = $req->name;
        $isEdit->slug = Str::slug($req->name);
        $isEdit->short_description = $req->short_description;
        $isEdit->description = $req->description;
        $isEdit->price = $req->price;
        $isEdit->status = $req->status;
        $isEdit->stock = $req->stock;
        $isEdit->category_id = $req->category_id;

        if ($req->hasFile('image')) {
            if ($isEdit->image && file_exists(public_path('uploads/products/'.$isEdit->image))) {
                unlink(public_path('uploads/products/'.$isEdit->image));
            }

            $image = $req->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('uploads/products'), $imageName);
            $isEdit->image = $imageName;
        }

        $isEdit->save();

        return redirect(url('admin/product'));
    }

    function deleteProduct($id){
        $isDeleted = Product::destroy($id);

        if($isDeleted){
            return redirect(url('admin/product'));
        }else {
            return "something Wrong";
        }
    }

    function orders()
    {
        $orders = Order::with('user')
            ->latest()
            ->paginate(6);

        return view('admin-orders', [
            'orders' => $orders
        ]);
    }

    function orderDetails($id)
    {
        $order = Order::with('items.product', 'user')
            ->findOrFail($id);

        return view('admin-order-details', [
            'order' => $order
        ]);
    }

    function updateOrderStatus(Request $req, $id)
    {
        $req->validate([
            'order_status' => 'required|in:pending,confirmed,shipped,delivered,cancelled',
        ]);

        $order = Order::findOrFail($id);

        $order->order_status = $req->order_status;
        $order->save();

        return back()->with('success', 'Order status updated successfully.');
    }

}
