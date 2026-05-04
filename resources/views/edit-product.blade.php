<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viora | Edit Product</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        @media (max-width: 767px) {
            #mobileSidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            #mobileSidebar.active {
                transform: translateX(0);
            }
        }
    </style>
</head>

<body class="bg-[#f6f1ea] text-gray-900">

<div class="min-h-screen flex">

    <!-- Mobile Overlay -->
    <div id="sidebarOverlay" onclick="closeSidebar()" class="fixed inset-0 bg-black/40 z-40 hidden md:hidden"></div>

    <!-- Sidebar -->
    <aside id="mobileSidebar" class="fixed md:static z-50 md:z-auto w-64 min-h-screen bg-[#111111] text-white flex flex-col">

        <div class="px-6 py-7 border-b border-white/10">
            <h1 class="text-2xl tracking-[0.35em] uppercase">Viora</h1>
            <p class="text-xs text-white/50 mt-2 tracking-[0.2em] uppercase">Admin Panel</p>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ url('admin') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition">
                <i class="fa-solid fa-chart-line w-5"></i>
                Dashboard
            </a>

            <a href="{{ url('admin/product') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-white text-black">
                <i class="fa-solid fa-shirt w-5"></i>
                Products
            </a>

            <a href="{{ url('admin/category') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition">
                <i class="fa-solid fa-layer-group w-5"></i>
                Categories
            </a>

            <a href="{{ url('admin/orders') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition">
                <i class="fa-solid fa-bag-shopping w-5"></i>
                Orders
            </a>
        </nav>

        <div class="px-4 py-5 border-t border-white/10">
            <form action="{{ url('logout') }}" method="post">
                @csrf
                <button class="w-full text-left px-4 py-3 rounded-lg text-white/70 hover:bg-red-500/20 hover:text-red-300 transition">
                    <i class="fa-solid fa-right-from-bracket mr-2"></i>
                    Logout
                </button>
            </form>
        </div>

    </aside>

    <!-- Main -->
    <main class="flex-1 min-w-0">

        <!-- Navbar -->
        <header class="h-16 border-b border-black/10 flex items-center justify-between px-5 md:px-10 bg-[#f6f1ea]/90 backdrop-blur-md sticky top-0 z-30">
            <div class="flex items-center gap-4">
                <button onclick="openSidebar()" class="md:hidden w-10 h-10 rounded-xl border border-black/10 bg-white flex items-center justify-center">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <div>
                    <h2 class="text-xl font-light">Edit Product</h2>
                    <p class="text-xs text-gray-500">Update product information</p>
                </div>
            </div>

            <a href="{{ url('admin/product') }}" class="hidden sm:inline-flex items-center gap-2 text-sm text-gray-500 hover:text-black transition">
                <i class="fa-solid fa-arrow-left text-xs"></i>
                Back to Products
            </a>
        </header>

        <!-- Content -->
        <div class="p-5 md:p-8">

            <!-- Page Header -->
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-5 mb-6">
                <div>
                    <a href="{{ url('admin/product') }}" class="inline-flex sm:hidden items-center gap-2 text-sm text-gray-500 hover:text-black transition mb-4">
                        <i class="fa-solid fa-arrow-left text-xs"></i>
                        Back to Products
                    </a>

                    <p class="text-xs uppercase tracking-[0.3em] text-gray-500 mb-2">Inventory</p>
                    <h1 class="text-3xl md:text-4xl font-light">Edit Product</h1>
                    <p class="mt-2 text-sm text-gray-500 max-w-2xl">
                        Update product name, description, image, pricing, stock and visibility status.
                    </p>
                </div>

                <div class="bg-black text-white rounded-2xl px-5 py-4 w-full sm:w-fit">
                    <p class="text-xs uppercase tracking-[0.2em] text-white/50">Product ID</p>
                    <h3 class="mt-1 text-xl font-semibold">#{{ $product->id }}</h3>
                </div>
            </div>

            <!-- Errors -->
            @if ($errors->any())
                <div class="mb-6 rounded-2xl border border-red-100 bg-red-50 px-5 py-4 text-red-700 text-sm">
                    <p class="font-semibold mb-2">
                        <i class="fa-solid fa-triangle-exclamation mr-2"></i>
                        Please fix the following errors:
                    </p>

                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('admin/product/edit-product/'.$product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 xl:grid-cols-[1fr_360px] gap-6 items-start">

                    <!-- Left Form -->
                    <div class="space-y-6">

                        <!-- Product Information -->
                        <div class="bg-white rounded-2xl border border-black/5 p-6 md:p-8 shadow-sm">
                            <div class="mb-7">
                                <p class="text-xs uppercase tracking-[0.25em] text-gray-500 mb-2">Step 01</p>
                                <h2 class="text-2xl font-light">Product Information</h2>
                                <p class="mt-2 text-sm text-gray-500">
                                    Keep product details clear for better product cards and detail pages.
                                </p>
                            </div>

                            <div class="space-y-5">

                                <div>
                                    <label class="block text-xs uppercase tracking-[0.22em] text-gray-500 mb-3">
                                        Product Name
                                    </label>

                                    <input 
                                        type="text" 
                                        name="name" 
                                        value="{{ old('name', $product->name) }}"
                                        placeholder="Oversized cotton shirt"
                                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-4 outline-none focus:border-black transition"
                                    >
                                </div>

                                <div>
                                    <label class="block text-xs uppercase tracking-[0.22em] text-gray-500 mb-3">
                                        Short Description
                                    </label>

                                    <textarea 
                                        name="short_description"
                                        rows="2"
                                        placeholder="Short description for product card"
                                        class="w-full resize-none rounded-xl border border-gray-200 bg-white px-4 py-4 outline-none focus:border-black transition"
                                    >{{ old('short_description', $product->short_description) }}</textarea>
                                </div>

                                <div>
                                    <label class="block text-xs uppercase tracking-[0.22em] text-gray-500 mb-3">
                                        Full Description
                                    </label>

                                    <textarea 
                                        name="description" 
                                        rows="6" 
                                        placeholder="Write complete product details..."
                                        class="w-full resize-none rounded-xl border border-gray-200 bg-white px-4 py-4 outline-none focus:border-black transition"
                                    >{{ old('description', $product->description) }}</textarea>
                                </div>

                            </div>
                        </div>

                        <!-- Pricing & Inventory -->
                        <div class="bg-white rounded-2xl border border-black/5 p-6 md:p-8 shadow-sm">
                            <div class="mb-7">
                                <p class="text-xs uppercase tracking-[0.25em] text-gray-500 mb-2">Step 02</p>
                                <h2 class="text-2xl font-light">Pricing & Inventory</h2>
                                <p class="mt-2 text-sm text-gray-500">
                                    Update price, stock, category and product visibility status.
                                </p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                <div>
                                    <label class="block text-xs uppercase tracking-[0.22em] text-gray-500 mb-3">
                                        Price
                                    </label>

                                    <input 
                                        type="number" 
                                        name="price" 
                                        value="{{ old('price', $product->getRawOriginal('price')) }}"
                                        placeholder="1299"
                                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-4 outline-none focus:border-black transition"
                                    >
                                </div>

                                <div>
                                    <label class="block text-xs uppercase tracking-[0.22em] text-gray-500 mb-3">
                                        Stock
                                    </label>

                                    <input 
                                        type="number" 
                                        name="stock" 
                                        value="{{ old('stock', $product->stock) }}"
                                        placeholder="25"
                                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-4 outline-none focus:border-black transition"
                                    >
                                </div>

                                <div>
                                    <label class="block text-xs uppercase tracking-[0.22em] text-gray-500 mb-3">
                                        Category
                                    </label>

                                    <select 
                                        name="category_id"
                                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-4 outline-none focus:border-black transition"
                                    >
                                        <option value="">Select Category</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-xs uppercase tracking-[0.22em] text-gray-500 mb-3">
                                        Status
                                    </label>

                                    <select 
                                        name="status"
                                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-4 outline-none focus:border-black transition"
                                    >
                                        <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                    </div>

                    <!-- Right Sidebar -->
                    <aside class="space-y-6 xl:sticky xl:top-24">

                        <!-- Image Upload -->
                        <div class="bg-white rounded-2xl border border-black/5 p-6 shadow-sm">
                            <div class="mb-5">
                                <p class="text-xs uppercase tracking-[0.25em] text-gray-500 mb-2">Step 03</p>
                                <h2 class="text-2xl font-light">Product Image</h2>
                                <p class="mt-2 text-sm text-gray-500">
                                    Click image box to upload a new product image.
                                </p>
                            </div>

                            <label class="block cursor-pointer">
                                <div class="relative rounded-2xl border-2 border-dashed border-gray-200 bg-[#f6f1ea] min-h-[280px] flex items-center justify-center overflow-hidden">
                                    <img 
                                        id="imagePreview" 
                                        src="{{ asset('uploads/products/'.$product->image) }}"
                                        class="absolute inset-0 w-full h-full object-cover"
                                        alt="{{ $product->name }}"
                                    >

                                    <div class="absolute inset-x-4 bottom-4 bg-black/75 text-white rounded-xl px-4 py-3 backdrop-blur-sm">
                                        <p class="text-xs">
                                            <i class="fa-solid fa-image mr-1"></i>
                                            Click here to change image
                                        </p>
                                    </div>
                                </div>

                                <input 
                                    id="imageInput"
                                    type="file" 
                                    name="image"
                                    accept="image/*"
                                    class="hidden"
                                >
                            </label>

                            <p class="mt-3 text-xs text-gray-500">
                                Leave unchanged if you do not want to replace the image.
                            </p>
                        </div>

                        <!-- Update Card -->
                        <div class="bg-[#111111] text-white rounded-2xl p-6 shadow-sm">
                            <p class="text-xs uppercase tracking-[0.25em] text-white/40 mb-3">
                                Update
                            </p>

                            <h2 class="text-2xl font-light mb-4">
                                Save product?
                            </h2>

                            <p class="text-sm text-white/60 leading-6 mb-6">
                                Changes will update this product across collection, product detail page and admin panel.
                            </p>

                            <button 
                                type="submit"
                                class="w-full bg-white text-black rounded-xl px-5 py-4 text-sm font-semibold hover:bg-[#f6f1ea] transition"
                            >
                                <i class="fa-solid fa-check mr-2"></i>
                                Update Product
                            </button>

                            <a href="{{ url('admin/product') }}"
                               class="mt-3 w-full inline-flex items-center justify-center rounded-xl border border-white/15 px-5 py-4 text-sm text-white/80 hover:bg-white hover:text-black transition">
                                Cancel
                            </a>
                        </div>

                        <!-- Product Preview -->
                        <div class="bg-white rounded-2xl border border-black/5 p-6 shadow-sm">
                            <p class="text-xs uppercase tracking-[0.25em] text-gray-500 mb-3">
                                Current Preview
                            </p>

                            <div class="rounded-2xl bg-[#f6f1ea] border border-black/5 overflow-hidden">
                                <img 
                                    src="{{ asset('uploads/products/'.$product->image) }}"
                                    class="w-full h-56 object-cover"
                                    alt="{{ $product->name }}"
                                >

                                <div class="p-5">
                                    <h3 class="font-semibold text-gray-900">
                                        {{ $product->name }}
                                    </h3>

                                    <p class="mt-2 text-sm text-gray-500 leading-6">
                                        {{ Str::limit($product->short_description ?? $product->description, 90) }}
                                    </p>

                                    <div class="mt-4 flex items-center justify-between gap-4">
                                        <p class="font-semibold">
                                            {{ $product->price }}
                                        </p>

                                        @if($product->status == 1)
                                            <span class="px-3 py-1 rounded-full text-xs bg-green-50 text-green-700 border border-green-100">
                                                Active
                                            </span>
                                        @else
                                            <span class="px-3 py-1 rounded-full text-xs bg-red-50 text-red-700 border border-red-100">
                                                Inactive
                                            </span>
                                        @endif
                                    </div>

                                    <div class="mt-4 pt-4 border-t border-black/5">
                                        @if($product->stock > 0)
                                            <p class="text-xs text-gray-500">
                                                Stock:
                                                <span class="font-semibold text-gray-900">{{ $product->stock }}</span>
                                            </p>
                                        @else
                                            <p class="text-xs text-red-600 font-semibold">
                                                Out of stock
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    </aside>

                </div>
            </form>

        </div>

    </main>

</div>

<script>
    function openSidebar() {
        document.getElementById('mobileSidebar').classList.add('active');
        document.getElementById('sidebarOverlay').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeSidebar() {
        document.getElementById('mobileSidebar').classList.remove('active');
        document.getElementById('sidebarOverlay').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');

    if (imageInput) {
        imageInput.addEventListener('change', function () {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                }

                reader.readAsDataURL(file);
            }
        });
    }
</script>

</body>
</html>