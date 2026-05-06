<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viora | Admin Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('uploads/product/logo.png') }}?v=2">
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
            <a href="{{ url('admin') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-white text-black">
                <i class="fa-solid fa-chart-line w-5"></i>
                Dashboard
            </a>

            <a href="{{ url('admin/product') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition">
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

        <div class="px-4 py-3 border-t border-white/10">
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

        <!-- Top Navbar -->
        <header class="h-16 border-b border-black/10 flex items-center justify-between px-5 md:px-10 bg-[#f6f1ea]/90 backdrop-blur-md sticky top-0 z-30">
            <div class="flex items-center gap-4">
                <button onclick="openSidebar()" class="md:hidden w-10 h-10 rounded-xl border border-black/10 bg-white flex items-center justify-center">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <div>
                    <h2 class="text-xl font-light">Dashboard</h2>
                    <p class="text-xs text-gray-500">Welcome back to Viora Admin</p>
                </div>
            </div>

            <div class="hidden sm:flex items-center gap-3">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-black transition">
                    <i class="fa-solid fa-store text-xs"></i>
                    View Store
                </a>
            </div>
        </header>

        <!-- Dashboard Content -->
        <section class="p-5 md:p-8">

            <!-- Header -->
            <div class="flex flex-col xl:flex-row xl:items-end xl:justify-between gap-6 mb-7">
                <div>
                    <p class="text-xs uppercase tracking-[0.3em] text-gray-500 mb-2">Overview</p>
                    <h1 class="text-3xl md:text-4xl font-light">Store Insights</h1>
                    <p class="mt-2 text-sm text-gray-500 max-w-2xl">
                        Manage products, categories, inventory and customer orders from one clean dashboard.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ url('admin/product/add-product') }}" class="inline-flex items-center justify-center gap-2 bg-black text-white px-6 py-3 rounded-full text-sm hover:bg-gray-900 transition">
                        <i class="fa-solid fa-plus text-xs"></i>
                        Add Product
                    </a>

                    <a href="{{ url('admin/category/add-category') }}" class="inline-flex items-center justify-center gap-2 border border-black/10 bg-white px-6 py-3 rounded-full text-sm hover:bg-black hover:text-white transition">
                        <i class="fa-solid fa-layer-group text-xs"></i>
                        Add Category
                    </a>
                </div>
            </div>

            <!-- KPI Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-7">

                <div class="bg-white rounded-2xl border border-black/5 p-6 shadow-sm hover:shadow-lg transition">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.2em] text-gray-500">Products</p>
                            <h2 class="mt-3 text-3xl font-semibold">{{ $productsCount ?? 0 }}</h2>
                            <p class="mt-2 text-sm text-gray-500">Total products listed</p>
                        </div>

                        <div class="w-12 h-12 rounded-2xl bg-[#f6f1ea] flex items-center justify-center">
                            <i class="fa-solid fa-shirt text-gray-700"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-black/5 p-6 shadow-sm hover:shadow-lg transition">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.2em] text-gray-500">Categories</p>
                            <h2 class="mt-3 text-3xl font-semibold">{{ $categoriesCount ?? 0 }}</h2>
                            <p class="mt-2 text-sm text-gray-500">Active collections</p>
                        </div>

                        <div class="w-12 h-12 rounded-2xl bg-[#f6f1ea] flex items-center justify-center">
                            <i class="fa-solid fa-layer-group text-gray-700"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-black/5 p-6 shadow-sm hover:shadow-lg transition">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.2em] text-gray-500">Orders</p>
                            <h2 class="mt-3 text-3xl font-semibold">{{ $ordersCount ?? 0 }}</h2>
                            <p class="mt-2 text-sm text-gray-500">{{ $pendingOrders ?? 0 }} pending orders</p>
                        </div>

                        <div class="w-12 h-12 rounded-2xl bg-[#f6f1ea] flex items-center justify-center">
                            <i class="fa-solid fa-bag-shopping text-gray-700"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-black text-white rounded-2xl border border-black p-6 shadow-sm hover:shadow-lg transition">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.2em] text-white/50">Revenue</p>
                            <h2 class="mt-3 text-3xl font-semibold">₹{{ $totalRevenue ?? 0 }}</h2>
                            <p class="mt-2 text-sm text-white/50">Except cancelled orders</p>
                        </div>

                        <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center">
                            <i class="fa-solid fa-indian-rupee-sign text-white"></i>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Inventory + Quick Actions -->
            <div class="grid grid-cols-1 xl:grid-cols-[1fr_380px] gap-6 mb-7">

                <!-- Inventory Overview -->
                <div class="bg-white rounded-2xl border border-black/5 overflow-hidden shadow-sm">
                    <div class="px-6 py-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div>
                            <h2 class="text-lg font-medium">Inventory Overview</h2>
                            <p class="text-sm text-gray-500">Quick stock health summary for your products.</p>
                        </div>

                        <a href="{{ url('admin/product') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-black transition">
                            Manage Products
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-0">
                        <div class="p-6 border-b sm:border-b-0 sm:border-r border-gray-100">
                            <div class="flex items-center justify-between gap-4 mb-4">
                                <p class="text-xs uppercase tracking-[0.2em] text-gray-500">In Stock</p>
                                <span class="w-10 h-10 rounded-xl bg-green-50 text-green-700 flex items-center justify-center">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                            </div>

                            <h3 class="text-4xl font-light">{{ $inStock ?? 0 }}</h3>
                            <p class="mt-2 text-sm text-gray-500">Products available for sale.</p>
                        </div>

                        <div class="p-6">
                            <div class="flex items-center justify-between gap-4 mb-4">
                                <p class="text-xs uppercase tracking-[0.2em] text-gray-500">Out of Stock</p>
                                <span class="w-10 h-10 rounded-xl bg-red-50 text-red-600 flex items-center justify-center">
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                </span>
                            </div>

                            <h3 class="text-4xl font-light">{{ $outStock ?? 0 }}</h3>
                            <p class="mt-2 text-sm text-gray-500">Products needing restock.</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Management -->
                <div class="bg-[#111111] text-white rounded-2xl p-6 shadow-sm">
                    <p class="text-xs uppercase tracking-[0.25em] text-white/40 mb-3">Quick Management</p>
                    <h2 class="text-2xl font-light mb-6">Shortcuts</h2>

                    <div class="space-y-3">
                        <a href="{{ url('admin/product') }}" class="flex items-center justify-between gap-4 bg-white/5 hover:bg-white/10 px-5 py-4 rounded-xl transition">
                            <span class="flex items-center gap-3">
                                <i class="fa-solid fa-shirt w-5 text-white/60"></i>
                                Products
                            </span>
                            <i class="fa-solid fa-arrow-right text-xs text-white/50"></i>
                        </a>

                        <a href="{{ url('admin/category') }}" class="flex items-center justify-between gap-4 bg-white/5 hover:bg-white/10 px-5 py-4 rounded-xl transition">
                            <span class="flex items-center gap-3">
                                <i class="fa-solid fa-layer-group w-5 text-white/60"></i>
                                Categories
                            </span>
                            <i class="fa-solid fa-arrow-right text-xs text-white/50"></i>
                        </a>

                        <a href="{{ url('admin/orders') }}" class="flex items-center justify-between gap-4 bg-white/5 hover:bg-white/10 px-5 py-4 rounded-xl transition">
                            <span class="flex items-center gap-3">
                                <i class="fa-solid fa-bag-shopping w-5 text-white/60"></i>
                                Orders
                            </span>
                            <i class="fa-solid fa-arrow-right text-xs text-white/50"></i>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Recent Orders + Management Cards -->
            <div class="grid grid-cols-1 xl:grid-cols-[1fr_380px] gap-6">

                <!-- Recent Orders -->
                <div class="bg-white rounded-2xl border border-black/5 overflow-hidden shadow-sm">
                    <div class="px-6 py-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div>
                            <h2 class="text-lg font-medium">Recent Orders</h2>
                            <p class="text-sm text-gray-500">Latest customer orders from your store.</p>
                        </div>

                        <a href="{{ url('admin/orders') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-black transition">
                            View All
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left min-w-[720px]">
                            <thead class="bg-black text-white">
                                <tr>
                                    <th class="px-6 py-4 text-xs uppercase tracking-[0.18em] font-normal">Order</th>
                                    <th class="px-6 py-4 text-xs uppercase tracking-[0.18em] font-normal">Customer</th>
                                    <th class="px-6 py-4 text-xs uppercase tracking-[0.18em] font-normal">Amount</th>
                                    <th class="px-6 py-4 text-xs uppercase tracking-[0.18em] font-normal">Status</th>
                                    <th class="px-6 py-4 text-xs uppercase tracking-[0.18em] font-normal text-right">Action</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">
                                @forelse($recentOrders ?? [] as $order)
                                    <tr class="hover:bg-[#faf7f2] transition">
                                        <td class="px-6 py-5">
                                            <p class="font-medium text-sm">{{ $order->order_number }}</p>
                                            <p class="text-xs text-gray-400 mt-1">{{ $order->created_at->format('d M Y') }}</p>
                                        </td>

                                        <td class="px-6 py-5">
                                            <p class="font-medium text-sm">{{ $order->user->name ?? 'N/A' }}</p>
                                            <p class="text-xs text-gray-500">{{ $order->email ?? 'No email' }}</p>
                                        </td>

                                        <td class="px-6 py-5 font-semibold text-sm">
                                            ₹{{ $order->total_amount }}
                                        </td>

                                        <td class="px-6 py-5">
                                            @if($order->order_status == 'pending')
                                                <span class="px-3 py-1 rounded-full text-xs bg-yellow-50 text-yellow-700 border border-yellow-100">Pending</span>
                                            @elseif($order->order_status == 'confirmed')
                                                <span class="px-3 py-1 rounded-full text-xs bg-blue-50 text-blue-700 border border-blue-100">Confirmed</span>
                                            @elseif($order->order_status == 'shipped')
                                                <span class="px-3 py-1 rounded-full text-xs bg-purple-50 text-purple-700 border border-purple-100">Shipped</span>
                                            @elseif($order->order_status == 'delivered')
                                                <span class="px-3 py-1 rounded-full text-xs bg-green-50 text-green-700 border border-green-100">Delivered</span>
                                            @elseif($order->order_status == 'cancelled')
                                                <span class="px-3 py-1 rounded-full text-xs bg-red-50 text-red-700 border border-red-100">Cancelled</span>
                                            @else
                                                <span class="px-3 py-1 rounded-full text-xs bg-gray-50 text-gray-700 border border-gray-100">{{ ucfirst($order->order_status) }}</span>
                                            @endif
                                        </td>

                                        <td class="px-6 py-5 text-right">
                                            <a href="{{ url('admin/orders/'.$order->id) }}" class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-gray-200 text-gray-600 hover:bg-black hover:text-white hover:border-black transition">
                                                <i class="fa-regular fa-eye text-sm"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-14 text-center">
                                            <div class="w-16 h-16 rounded-full bg-[#f6f1ea] flex items-center justify-center mx-auto mb-4">
                                                <i class="fa-solid fa-bag-shopping text-2xl text-gray-400"></i>
                                            </div>
                                            <h3 class="text-lg font-medium">No recent orders</h3>
                                            <p class="mt-2 text-sm text-gray-500">Customer orders will appear here.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Store Management -->
                <div class="space-y-5">
                    <a href="{{ url('admin/product') }}" class="block bg-white rounded-2xl border border-black/5 p-6 shadow-sm hover:shadow-lg transition">
                        <p class="text-xs uppercase tracking-[0.25em] text-gray-400 mb-4">Store</p>
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <h3 class="text-2xl font-light mb-2">Products</h3>
                                <p class="text-sm text-gray-500">Manage fashion products.</p>
                            </div>
                            <span class="w-11 h-11 rounded-xl bg-[#f6f1ea] flex items-center justify-center">
                                <i class="fa-solid fa-shirt"></i>
                            </span>
                        </div>
                    </a>

                    <a href="{{ url('admin/category') }}" class="block bg-white rounded-2xl border border-black/5 p-6 shadow-sm hover:shadow-lg transition">
                        <p class="text-xs uppercase tracking-[0.25em] text-gray-400 mb-4">Collection</p>
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <h3 class="text-2xl font-light mb-2">Categories</h3>
                                <p class="text-sm text-gray-500">Organize collections.</p>
                            </div>
                            <span class="w-11 h-11 rounded-xl bg-[#f6f1ea] flex items-center justify-center">
                                <i class="fa-solid fa-layer-group"></i>
                            </span>
                        </div>
                    </a>

                    <a href="{{ url('admin/orders') }}" class="block bg-white rounded-2xl border border-black/5 p-6 shadow-sm hover:shadow-lg transition">
                        <p class="text-xs uppercase tracking-[0.25em] text-gray-400 mb-4">Sales</p>
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <h3 class="text-2xl font-light mb-2">Orders</h3>
                                <p class="text-sm text-gray-500">Manage customer orders.</p>
                            </div>
                            <span class="w-11 h-11 rounded-xl bg-[#f6f1ea] flex items-center justify-center">
                                <i class="fa-solid fa-bag-shopping"></i>
                            </span>
                        </div>
                    </a>
                </div>

            </div>

        </section>

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