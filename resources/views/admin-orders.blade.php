<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viora | Admin Orders</title>

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
            <a href="{{ url('admin') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-white/70 hover:bg-white/10 transition">
                <i class="fa-solid fa-chart-line w-5"></i>
                Dashboard
            </a>

            <a href="{{ url('admin/product') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-white/70 hover:bg-white/10 transition">
                <i class="fa-solid fa-shirt w-5"></i>
                Products
            </a>

            <a href="{{ url('admin/category') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-white/70 hover:bg-white/10 transition">
                <i class="fa-solid fa-layer-group w-5"></i>
                Categories
            </a>

            <a href="{{ url('admin/orders') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-white text-black">
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
                    <h2 class="text-xl font-light">Orders</h2>
                    <p class="text-xs text-gray-500">Manage customer orders</p>
                </div>
            </div>

            <a href="{{ url('admin') }}" class="hidden sm:inline-flex items-center gap-2 text-sm text-gray-500 hover:text-black transition">
                <i class="fa-solid fa-arrow-left text-xs"></i>
                Back to Dashboard
            </a>
        </header>

        <!-- Content -->
        <div class="p-5 md:p-8">

            <!-- Page Header -->
            <div class="flex flex-col lg:flex-row lg:justify-between lg:items-end gap-5 mb-6">
                <div>
                    <p class="text-xs uppercase tracking-[0.3em] text-gray-500 mb-2">Order Management</p>
                    <h1 class="text-3xl md:text-4xl font-light">Order List</h1>
                    <p class="mt-2 text-sm text-gray-500">
                        View customer orders, amount, status and order date.
                    </p>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    <div class="bg-white border border-black/5 rounded-2xl px-4 py-3 shadow-sm">
                        <p class="text-xs text-gray-500">Total</p>
                        <h3 class="text-xl font-semibold">{{ $orders->total() }}</h3>
                    </div>

                    <div class="bg-white border border-black/5 rounded-2xl px-4 py-3 shadow-sm">
                        <p class="text-xs text-gray-500">Page</p>
                        <h3 class="text-xl font-semibold">{{ $orders->currentPage() }}</h3>
                    </div>

                    <div class="bg-white border border-black/5 rounded-2xl px-4 py-3 shadow-sm">
                        <p class="text-xs text-gray-500">Showing</p>
                        <h3 class="text-xl font-semibold">{{ $orders->count() }}</h3>
                    </div>

                    <div class="bg-black text-white border border-black rounded-2xl px-4 py-3 shadow-sm">
                        <p class="text-xs text-white/60">Module</p>
                        <h3 class="text-xl font-semibold">Orders</h3>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-5 rounded-2xl border border-green-100 bg-green-50 px-5 py-4 text-green-700 text-sm">
                    <i class="fa-solid fa-circle-check mr-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Table Card -->
            <div class="bg-white rounded-2xl border border-black/5 overflow-hidden shadow-sm">

                <div class="px-6 py-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <h2 class="text-lg font-medium">Recent Orders</h2>
                        <p class="text-sm text-gray-500">All orders placed by users are listed here.</p>
                    </div>

                    <a href="{{ url('admin/orders') }}" class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-full border border-gray-200 text-sm hover:bg-black hover:text-white hover:border-black transition">
                        <i class="fa-solid fa-rotate-right text-xs"></i>
                        Refresh
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left min-w-[900px]">

                        <thead class="bg-black text-white">
                            <tr>
                                <th class="px-6 py-4 text-xs uppercase tracking-[0.18em] font-normal">Order No</th>
                                <th class="px-6 py-4 text-xs uppercase tracking-[0.18em] font-normal">User</th>
                                <th class="px-6 py-4 text-xs uppercase tracking-[0.18em] font-normal">Amount</th>
                                <th class="px-6 py-4 text-xs uppercase tracking-[0.18em] font-normal">Date</th>
                                <th class="px-6 py-4 text-xs uppercase tracking-[0.18em] font-normal">Status</th>
                                <th class="px-6 py-4 text-xs uppercase tracking-[0.18em] font-normal text-right">Action</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @forelse($orders as $order)
                                <tr class="hover:bg-[#faf7f2] transition">

                                    <td class="px-6 py-5">
                                        <p class="font-medium text-sm text-gray-900">
                                            {{ $order->order_number }}
                                        </p>
                                        <p class="text-xs text-gray-400 mt-1">
                                            ID: #{{ $order->id }}
                                        </p>
                                    </td>

                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-[#f6f1ea] border border-black/5 flex items-center justify-center text-sm font-semibold">
                                                {{ strtoupper(substr($order->user->name ?? 'U', 0, 1)) }}
                                            </div>

                                            <div>
                                                <p class="font-medium text-sm">
                                                    {{ $order->user->name ?? 'N/A' }}
                                                </p>
                                                <p class="text-xs text-gray-500">
                                                    {{ $order->email ?? 'No email' }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-5">
                                        <p class="font-semibold text-sm">
                                            ₹{{ $order->total_amount }}
                                        </p>
                                    </td>

                                    <td class="px-6 py-5">
                                        <p class="text-sm text-gray-700">
                                            {{ $order->created_at->format('d M Y') }}
                                        </p>
                                        <p class="text-xs text-gray-400 mt-1">
                                            {{ $order->created_at->format('h:i A') }}
                                        </p>
                                    </td>

                                    <td class="px-6 py-5">
                                        @if($order->order_status == 'pending')
                                            <span class="px-3 py-1 rounded-full text-xs bg-yellow-50 text-yellow-700 border border-yellow-100">
                                                Pending
                                            </span>
                                        @elseif($order->order_status == 'confirmed')
                                            <span class="px-3 py-1 rounded-full text-xs bg-blue-50 text-blue-700 border border-blue-100">
                                                Confirmed
                                            </span>
                                        @elseif($order->order_status == 'shipped')
                                            <span class="px-3 py-1 rounded-full text-xs bg-purple-50 text-purple-700 border border-purple-100">
                                                Shipped
                                            </span>
                                        @elseif($order->order_status == 'delivered')
                                            <span class="px-3 py-1 rounded-full text-xs bg-green-50 text-green-700 border border-green-100">
                                                Delivered
                                            </span>
                                        @elseif($order->order_status == 'cancelled')
                                            <span class="px-3 py-1 rounded-full text-xs bg-red-50 text-red-700 border border-red-100">
                                                Cancelled
                                            </span>
                                        @else
                                            <span class="px-3 py-1 rounded-full text-xs bg-gray-50 text-gray-700 border border-gray-100">
                                                {{ ucfirst($order->order_status) }}
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-5">
                                        <div class="flex items-center justify-end gap-2">

                                            <a href="{{ url('admin/orders/'.$order->id) }}"
                                               class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-gray-200 text-gray-600 hover:bg-black hover:text-white hover:border-black transition text-sm"
                                               title="View Details">
                                                <i class="fa-regular fa-eye text-sm"></i>
                                                View
                                            </a>

                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-16 text-center">
                                        <div class="max-w-md mx-auto">
                                            <div class="w-16 h-16 rounded-full bg-[#f6f1ea] flex items-center justify-center mx-auto mb-4">
                                                <i class="fa-solid fa-bag-shopping text-2xl text-gray-400"></i>
                                            </div>

                                            <h3 class="text-xl font-medium">No orders found</h3>
                                            <p class="text-sm text-gray-500 mt-2">
                                                Orders placed by customers will appear here.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                <!-- Pagination -->
                @if($orders->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100 bg-white">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                            <p class="text-sm text-gray-500">
                                Showing {{ $orders->firstItem() ?? 0 }}
                                to {{ $orders->lastItem() ?? 0 }}
                                of {{ $orders->total() }} orders
                            </p>

                            <div class="flex items-center gap-2 flex-wrap">

                                @if ($orders->onFirstPage())
                                    <span class="px-4 py-2 rounded-full border text-sm text-gray-300 cursor-not-allowed">
                                        Previous
                                    </span>
                                @else
                                    <a href="{{ $orders->previousPageUrl() }}"
                                       class="px-4 py-2 rounded-full border text-sm hover:bg-black hover:text-white transition">
                                        Previous
                                    </a>
                                @endif

                                @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                                    @if ($page == $orders->currentPage())
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

                                @if ($orders->hasMorePages())
                                    <a href="{{ $orders->nextPageUrl() }}"
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