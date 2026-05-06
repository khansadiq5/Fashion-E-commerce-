<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viora | Products</title>
    <link rel="icon" type="image/png" href="{{ asset('uploads/product/logo.png') }}">
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
                    <h2 class="text-xl font-light">Products</h2>
                    <p class="text-xs text-gray-500">Manage all fashion products</p>
                </div>
            </div>

            <a href="{{ url('admin') }}" class="hidden sm:inline-flex items-center gap-2 text-sm text-gray-500 hover:text-black transition">
                <i class="fa-solid fa-arrow-left text-xs"></i>
                Back to Dashboard
            </a>
        </header>

        <!-- Content -->
        <div class="p-5 md:p-8">

            <!-- Header -->
            <div class="flex flex-col xl:flex-row xl:justify-between xl:items-end gap-5 mb-6">
                <div>
                    <p class="text-xs uppercase tracking-[0.3em] text-gray-500 mb-2">Inventory</p>
                    <h1 class="text-3xl md:text-4xl font-light">Product List</h1>
                    <p class="mt-2 text-sm text-gray-500">
                        View, edit and manage all products available in your Viora store.
                    </p>
                </div>

                <a href="{{ url('admin/product/add-product') }}"
                   class="inline-flex items-center justify-center gap-2 bg-black text-white px-6 py-3 rounded-full text-sm hover:bg-gray-900 transition w-fit">
                    <i class="fa-solid fa-plus text-xs"></i>
                    Add Product
                </a>
            </div>

            <!-- KPI Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-2xl border border-black/5 px-5 py-4 shadow-sm">
                    <p class="text-xs uppercase tracking-[0.2em] text-gray-500">Total Products</p>
                    <h3 class="mt-2 text-2xl font-semibold">{{ $products->total() ?? $products->count() }}</h3>
                </div>

                <div class="bg-white rounded-2xl border border-black/5 px-5 py-4 shadow-sm">
                    <p class="text-xs uppercase tracking-[0.2em] text-gray-500">Showing</p>
                    <h3 class="mt-2 text-2xl font-semibold">{{ $products->count() }}</h3>
                </div>

                <div class="bg-white rounded-2xl border border-black/5 px-5 py-4 shadow-sm">
                    <p class="text-xs uppercase tracking-[0.2em] text-gray-500">Current Page</p>
                    <h3 class="mt-2 text-2xl font-semibold">{{ method_exists($products, 'currentPage') ? $products->currentPage() : 1 }}</h3>
                </div>

                <div class="bg-black text-white rounded-2xl border border-black px-5 py-4 shadow-sm">
                    <p class="text-xs uppercase tracking-[0.2em] text-white/50">Module</p>
                    <h3 class="mt-2 text-2xl font-semibold">Products</h3>
                </div>
            </div>

            <!-- Table Card -->
            <div class="bg-white rounded-2xl border border-black/5 overflow-hidden shadow-sm">

                <div class="px-6 py-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <h2 class="text-lg font-medium">All Products</h2>
                        <p class="text-sm text-gray-500">Product image, stock, price, status and actions.</p>
                    </div>

                    <a href="{{ url('admin/product') }}" class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-full border border-gray-200 text-sm hover:bg-black hover:text-white hover:border-black transition">
                        <i class="fa-solid fa-rotate-right text-xs"></i>
                        Refresh
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left min-w-[1050px]">

                        <thead class="bg-black text-white">
                            <tr>
                                <th class="px-6 py-4 text-xs uppercase tracking-[0.18em] font-normal">Image</th>
                                <th class="px-6 py-4 text-xs uppercase tracking-[0.18em] font-normal">Name</th>
                                <th class="px-6 py-4 text-xs uppercase tracking-[0.18em] font-normal">Price</th>
                                <th class="px-6 py-4 text-xs uppercase tracking-[0.18em] font-normal">Description</th>
                                <th class="px-6 py-4 text-xs uppercase tracking-[0.18em] font-normal">Stock</th>
                                <th class="px-6 py-4 text-xs uppercase tracking-[0.18em] font-normal">Status</th>
                                <th class="px-6 py-4 text-xs uppercase tracking-[0.18em] font-normal text-right">Action</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @forelse ($products as $product)
                                <tr class="hover:bg-[#faf7f2] transition">

                                    <td class="px-6 py-4">
                                        <div class="w-14 h-16 rounded-xl overflow-hidden border border-gray-200 bg-gray-100">
                                            <img 
                                                src="{{ asset('uploads/products/'.$product->image) }}" 
                                                class="w-full h-full object-cover"
                                                alt="{{ $product->name }}"
                                            >
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <p class="font-medium text-sm text-gray-900">
                                            {{ $product->name }}
                                        </p>

                                        <p class="text-xs text-gray-400 mt-1">
                                            ID: #{{ $product->id }}
                                        </p>
                                    </td>

                                    <td class="px-6 py-4 text-sm font-semibold">
                                        {{ $product->price }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-500 max-w-xs">
                                        <p class="line-clamp-2">
                                            {{ Str::limit($product->short_description ?? $product->description, 55) }}
                                        </p>
                                    </td>

                                    <td class="px-6 py-4">
                                        @if($product->stock > 0)
                                            <span class="inline-flex items-center gap-2 text-sm font-medium text-gray-800">
                                                <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                                {{ $product->stock }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-2 text-sm font-medium text-red-600">
                                                <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                                Out
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">
                                        @if($product->status == 1)
                                            <span class="px-3 py-1 rounded-full text-xs bg-green-50 text-green-700 border border-green-100">
                                                Active
                                            </span>
                                        @else
                                            <span class="px-3 py-1 rounded-full text-xs bg-red-50 text-red-700 border border-red-100">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-end gap-2">

                                            <!-- Edit -->
                                            <a href="{{ url('admin/product/edit/'.$product->id) }}"
                                               class="w-9 h-9 flex items-center justify-center rounded-xl border border-gray-200 text-gray-600 hover:bg-black hover:text-white hover:border-black transition"
                                               title="Edit">
                                                <i class="fa-regular fa-pen-to-square text-sm"></i>
                                            </a>

                                            <!-- Delete -->
                                            <a href="{{ url('admin/product/delete/'.$product->id) }}"
                                               onclick="return confirm('Are you sure you want to delete this product?')"
                                               class="w-9 h-9 flex items-center justify-center rounded-xl border border-red-100 text-red-500 hover:bg-red-500 hover:text-white hover:border-red-500 transition"
                                               title="Delete">
                                                <i class="fa-regular fa-trash-can text-sm"></i>
                                            </a>

                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-16 text-center">
                                        <div class="max-w-md mx-auto">
                                            <div class="w-16 h-16 rounded-full bg-[#f6f1ea] flex items-center justify-center mx-auto mb-4">
                                                <i class="fa-solid fa-shirt text-2xl text-gray-400"></i>
                                            </div>

                                            <h3 class="text-xl font-medium">No products found</h3>
                                            <p class="text-sm text-gray-500 mt-2">
                                                Add your first product to start building your Viora collection.
                                            </p>

                                            <a href="{{ url('admin/product/add-product') }}"
                                               class="mt-6 inline-flex items-center justify-center gap-2 bg-black text-white px-6 py-3 rounded-full text-sm hover:bg-gray-900 transition">
                                                <i class="fa-solid fa-plus text-xs"></i>
                                                Add Product
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                <!-- Pagination -->
                @if(method_exists($products, 'hasPages') && $products->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100 bg-white">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                            <p class="text-sm text-gray-500">
                                Showing {{ $products->firstItem() ?? 0 }}
                                to {{ $products->lastItem() ?? 0 }}
                                of {{ $products->total() }} products
                            </p>

                            <div class="flex items-center gap-2 flex-wrap">

                                @if ($products->onFirstPage())
                                    <span class="px-4 py-2 rounded-full border text-sm text-gray-300 cursor-not-allowed">
                                        Previous
                                    </span>
                                @else
                                    <a href="{{ $products->previousPageUrl() }}"
                                       class="px-4 py-2 rounded-full border text-sm hover:bg-black hover:text-white transition">
                                        Previous
                                    </a>
                                @endif

                                @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                    @if ($page == $products->currentPage())
                                        <span class="w-9 h-9 flex items-center justify-center rounded-full bg-black text-white text-sm">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <a href="{{ $url }}"
                                           class="w-9 h-9 flex items-center justify-center rounded-full border text-sm hover:bg-black hover:text-white transition">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endforeach

                                @if ($products->hasMorePages())
                                    <a href="{{ $products->nextPageUrl() }}"
                                       class="px-4 py-2 rounded-full border text-sm hover:bg-black hover:text-white transition">
                                        Next
                                    </a>
                                @else
                                    <span class="px-4 py-2 rounded-full border text-sm text-gray-300 cursor-not-allowed">
                                        Next
                                    </span>
                                @endif

                            </div>

                        </div>
                    </div>
                @endif

            </div>

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
</script>

</body>
</html>