<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viora | Admin Order Details</title>

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
                    <h2 class="text-xl font-light">Order Details</h2>
                    <p class="text-xs text-gray-500">View and update order information</p>
                </div>
            </div>

            <a href="{{ url('admin/orders') }}" class="hidden sm:inline-flex items-center gap-2 text-sm text-gray-500 hover:text-black transition">
                <i class="fa-solid fa-arrow-left text-xs"></i>
                Back to Orders
            </a>
        </header>

        <!-- Content -->
        <div class="p-5 md:p-8">

            <!-- Page Header -->
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-5 mb-6">
                <div>
                    <a href="{{ url('admin/orders') }}" class="inline-flex sm:hidden items-center gap-2 text-sm text-gray-500 hover:text-black transition mb-4">
                        <i class="fa-solid fa-arrow-left text-xs"></i>
                        Back to Orders
                    </a>

                    <p class="text-xs uppercase tracking-[0.3em] text-gray-500 mb-2">Order Management</p>

                    <h1 class="text-3xl md:text-4xl font-light break-all">
                        {{ $order->order_number }}
                    </h1>

                    <p class="mt-2 text-sm text-gray-500">
                        Placed on {{ $order->created_at->format('d M Y') }} at {{ $order->created_at->format('h:i A') }}
                    </p>
                </div>

                <div>
                    @if($order->order_status == 'pending')
                        <span class="inline-flex px-4 py-2 rounded-full text-xs bg-yellow-50 text-yellow-700 border border-yellow-100 uppercase tracking-[0.14em]">
                            Pending
                        </span>
                    @elseif($order->order_status == 'confirmed')
                        <span class="inline-flex px-4 py-2 rounded-full text-xs bg-blue-50 text-blue-700 border border-blue-100 uppercase tracking-[0.14em]">
                            Confirmed
                        </span>
                    @elseif($order->order_status == 'shipped')
                        <span class="inline-flex px-4 py-2 rounded-full text-xs bg-purple-50 text-purple-700 border border-purple-100 uppercase tracking-[0.14em]">
                            Shipped
                        </span>
                    @elseif($order->order_status == 'delivered')
                        <span class="inline-flex px-4 py-2 rounded-full text-xs bg-green-50 text-green-700 border border-green-100 uppercase tracking-[0.14em]">
                            Delivered
                        </span>
                    @elseif($order->order_status == 'cancelled')
                        <span class="inline-flex px-4 py-2 rounded-full text-xs bg-red-50 text-red-700 border border-red-100 uppercase tracking-[0.14em]">
                            Cancelled
                        </span>
                    @else
                        <span class="inline-flex px-4 py-2 rounded-full text-xs bg-gray-50 text-gray-700 border border-gray-100 uppercase tracking-[0.14em]">
                            {{ ucfirst($order->order_status) }}
                        </span>
                    @endif
                </div>
            </div>

            @if(session('success'))
                <div class="mb-5 rounded-2xl border border-green-100 bg-green-50 px-5 py-4 text-green-700 text-sm">
                    <i class="fa-solid fa-circle-check mr-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-2xl border border-black/5 p-5 shadow-sm">
                    <p class="text-xs uppercase tracking-[0.2em] text-gray-500">Customer</p>
                    <h3 class="mt-2 text-lg font-semibold truncate">{{ $order->user->name ?? 'N/A' }}</h3>
                    <p class="text-sm text-gray-500 truncate">{{ $order->email }}</p>
                </div>

                <div class="bg-white rounded-2xl border border-black/5 p-5 shadow-sm">
                    <p class="text-xs uppercase tracking-[0.2em] text-gray-500">Amount</p>
                    <h3 class="mt-2 text-2xl font-semibold">₹{{ $order->total_amount }}</h3>
                    <p class="text-sm text-gray-500">{{ $order->payment_method }}</p>
                </div>

                <div class="bg-white rounded-2xl border border-black/5 p-5 shadow-sm">
                    <p class="text-xs uppercase tracking-[0.2em] text-gray-500">Phone</p>
                    <h3 class="mt-2 text-lg font-semibold">{{ $order->phone }}</h3>
                    <p class="text-sm text-gray-500">Contact number</p>
                </div>

                <div class="bg-black text-white rounded-2xl border border-black p-5 shadow-sm">
                    <p class="text-xs uppercase tracking-[0.2em] text-white/50">Items</p>
                    <h3 class="mt-2 text-2xl font-semibold">{{ $order->items->count() }}</h3>
                    <p class="text-sm text-white/50">Products in order</p>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-[1fr_370px] gap-6 items-start">

                <!-- Left Content -->
                <div class="space-y-6">

                    <!-- Products Table -->
                    <div class="bg-white rounded-2xl border border-black/5 overflow-hidden shadow-sm">
                        <div class="px-6 py-5 border-b border-gray-100">
                            <h2 class="text-lg font-medium">Ordered Products</h2>
                            <p class="text-sm text-gray-500">Product quantity, price and subtotal details.</p>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left min-w-[760px]">

                                <thead class="bg-black text-white">
                                    <tr>
                                        <th class="px-6 py-4 text-xs uppercase tracking-[0.18em] font-normal">Product</th>
                                        <th class="px-6 py-4 text-xs uppercase tracking-[0.18em] font-normal">Price</th>
                                        <th class="px-6 py-4 text-xs uppercase tracking-[0.18em] font-normal">Qty</th>
                                        <th class="px-6 py-4 text-xs uppercase tracking-[0.18em] font-normal text-right">Subtotal</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-100">
                                    @foreach($order->items as $item)
                                        <tr class="hover:bg-[#faf7f2] transition">
                                            <td class="px-6 py-5">
                                                <div class="flex items-center gap-4">
                                                    <img 
                                                        src="{{ asset('uploads/products/'.$item->product_image) }}"
                                                        class="w-16 h-20 object-cover rounded-xl bg-[#f6f1ea] border border-black/5"
                                                        alt="{{ $item->product_name }}"
                                                    >

                                                    <div class="min-w-0">
                                                        <p class="font-medium text-sm text-gray-900">
                                                            {{ $item->product_name }}
                                                        </p>
                                                        <p class="text-xs text-gray-400 mt-1">
                                                            Product ID: #{{ $item->product_id }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="px-6 py-5 text-sm font-semibold">
                                                ₹{{ $item->price }}
                                            </td>

                                            <td class="px-6 py-5">
                                                <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-[#f6f1ea] border border-black/5 text-sm font-semibold">
                                                    {{ $item->quantity }}
                                                </span>
                                            </td>

                                            <td class="px-6 py-5 text-right text-sm font-semibold">
                                                ₹{{ $item->subtotal }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>

                    <!-- Shipping Address Mobile/Desktop -->
                    <div class="bg-white rounded-2xl border border-black/5 p-6 shadow-sm">
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl bg-[#f6f1ea] border border-black/5 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-location-dot text-gray-700"></i>
                            </div>

                            <div>
                                <p class="text-xs uppercase tracking-[0.2em] text-gray-500">Shipping Address</p>
                                <h3 class="mt-2 text-lg font-semibold">{{ $order->full_name }}</h3>
                                <p class="mt-2 text-sm text-gray-600 leading-7">
                                    {{ $order->phone }} <br>
                                    {{ $order->address }}, {{ $order->city }}, {{ $order->state }} - {{ $order->pincode }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Right Sidebar -->
                <aside class="space-y-6 xl:sticky xl:top-24">

                    <!-- Status Update -->
                    <div class="bg-white rounded-2xl border border-black/5 p-6 shadow-sm">
                        <div class="mb-5">
                            <p class="text-xs uppercase tracking-[0.2em] text-gray-500 mb-2">Update Status</p>
                            <h2 class="text-2xl font-light">Order Progress</h2>
                        </div>

                        <form action="{{ url('admin/orders/status/'.$order->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <label class="block text-sm text-gray-500 mb-2">Order Status</label>

                            <select name="order_status" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-white outline-none focus:border-black transition">
                                <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $order->order_status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>

                            <button class="mt-4 w-full bg-black text-white rounded-xl px-5 py-3 text-sm hover:bg-gray-900 transition">
                                <i class="fa-solid fa-arrows-rotate mr-2"></i>
                                Update Status
                            </button>
                        </form>
                    </div>

                    <!-- Order Information -->
                    <div class="bg-[#111111] text-white rounded-2xl p-6 shadow-sm">
                        <p class="text-xs uppercase tracking-[0.2em] text-white/50 mb-2">Order Information</p>
                        <h2 class="text-2xl font-light mb-6">Summary</h2>

                        <div class="space-y-4 text-sm">
                            <div class="flex items-center justify-between gap-4 border-b border-white/10 pb-3">
                                <span class="text-white/50">Order No</span>
                                <span class="font-medium text-right break-all">{{ $order->order_number }}</span>
                            </div>

                            <div class="flex items-center justify-between gap-4 border-b border-white/10 pb-3">
                                <span class="text-white/50">Total</span>
                                <span class="font-medium">₹{{ $order->total_amount }}</span>
                            </div>

                            <div class="flex items-center justify-between gap-4 border-b border-white/10 pb-3">
                                <span class="text-white/50">Payment</span>
                                <span class="font-medium">{{ $order->payment_method }}</span>
                            </div>

                            <div class="flex items-center justify-between gap-4 border-b border-white/10 pb-3">
                                <span class="text-white/50">Date</span>
                                <span class="font-medium">{{ $order->created_at->format('d M Y') }}</span>
                            </div>

                            <div class="flex items-center justify-between gap-4">
                                <span class="text-white/50">Time</span>
                                <span class="font-medium">{{ $order->created_at->format('h:i A') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Info -->
                    <div class="bg-white rounded-2xl border border-black/5 p-6 shadow-sm">
                        <p class="text-xs uppercase tracking-[0.2em] text-gray-500 mb-2">Customer</p>
                        <h2 class="text-2xl font-light mb-5">Contact Details</h2>

                        <div class="space-y-4 text-sm">
                            <div class="flex items-start gap-3">
                                <i class="fa-solid fa-user mt-1 text-gray-400 w-5"></i>
                                <div>
                                    <p class="text-gray-500">Name</p>
                                    <p class="font-medium">{{ $order->user->name ?? 'N/A' }}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <i class="fa-solid fa-envelope mt-1 text-gray-400 w-5"></i>
                                <div>
                                    <p class="text-gray-500">Email</p>
                                    <p class="font-medium break-all">{{ $order->email }}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <i class="fa-solid fa-phone mt-1 text-gray-400 w-5"></i>
                                <div>
                                    <p class="text-gray-500">Phone</p>
                                    <p class="font-medium">{{ $order->phone }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </aside>

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