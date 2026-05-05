<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success | Viora</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#f6f1ea] text-[#160c05] overflow-x-hidden">

<!-- NAVBAR -->
<nav class="relative z-40 w-full px-4 sm:px-6 lg:px-14 py-5">
    <div class="flex items-center justify-between">

        <a href="{{ url('/') }}" class="inline-flex items-center">
            <h2 class="text-[#1b0d03] text-xl sm:text-2xl tracking-[0.35em] uppercase font-medium">
                Viora
            </h2>
        </a>

        <div class="hidden lg:flex items-center gap-8 text-sm font-medium bg-white/45 backdrop-blur-md border border-white/60 px-5 py-3 rounded-full">
            <a href="{{ url('/') }}" class="hover:text-[#7a4d2a] transition">Home</a>
            <a href="{{ url('collection') }}" class="hover:text-[#7a4d2a] transition">Collection</a>
            <a href="{{ url('about') }}" class="hover:text-[#7a4d2a] transition">About Us</a>
            <a href="{{ url('contact') }}" class="hover:text-[#7a4d2a] transition">Contact Us</a>
        </div>

        <div class="hidden lg:flex items-center gap-4 relative">
            @auth
                <button 
                    type="button"
                    onclick="toggleProfileMenu()"
                    class="w-11 h-11 rounded-full bg-white/55 backdrop-blur-md border border-black/10 flex items-center justify-center hover:bg-[#1b0d03] hover:text-white transition"
                    title="Profile"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0" />
                    </svg>
                </button>

                <div id="profileMenu" class="hidden absolute right-14 top-14 w-56 bg-white border border-[#eadfd3] shadow-xl shadow-black/10 rounded-2xl overflow-hidden">
                    <div class="px-5 py-4 border-b border-[#eadfd3]">
                        <p class="text-xs uppercase tracking-[0.2em] text-[#8b7462] mb-1">Signed in as</p>
                        <p class="font-semibold text-[#1b0d03] truncate">{{ Auth::user()->name }}</p>
                    </div>

                    <a href="{{ url('my-orders') }}" class="block px-5 py-3 text-sm hover:bg-[#fff2e5] transition">
                        My Orders
                    </a>

                    <form action="{{ url('logout') }}" method="post">
                        @csrf
                        <button class="w-full text-left px-5 py-3 text-sm text-red-600 hover:bg-red-50 transition">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <a 
                    href="{{ url('login') }}"
                    class="w-11 h-11 rounded-full bg-white/55 backdrop-blur-md border border-black/10 flex items-center justify-center hover:bg-[#1b0d03] hover:text-white transition"
                    title="Login"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0" />
                    </svg>
                </a>
            @endauth

            <a 
                href="{{ url('cart') }}"
                class="w-11 h-11 rounded-full bg-[#1b0d03] text-white border border-black/10 flex items-center justify-center transition"
                title="Cart"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 7.5h10.5l-.75 12h-9l-.75-12zM9 7.5a3 3 0 016 0M9.75 11.25h.01M14.25 11.25h.01" />
                </svg>
            </a>
        </div>

        <div class="lg:hidden flex items-center gap-3">
            <a 
                href="{{ url('cart') }}"
                class="w-10 h-10 rounded-full bg-[#1b0d03] text-white border border-black/10 flex items-center justify-center"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 7.5h10.5l-.75 12h-9l-.75-12zM9 7.5a3 3 0 016 0M9.75 11.25h.01M14.25 11.25h.01" />
                </svg>
            </a>

            <button 
                type="button"
                onclick="openMobileMenu()"
                class="w-10 h-10 rounded-full bg-white/60 backdrop-blur-md border border-black/10 flex items-center justify-center"
            >
                <span class="text-2xl leading-none">☰</span>
            </button>
        </div>

    </div>
</nav>

<!-- MOBILE SIDE MENU -->
<div id="mobileMenuOverlay" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/45" onclick="closeMobileMenu()"></div>

    <div id="mobileDrawer" class="absolute top-0 left-0 h-full w-[82%] max-w-sm bg-[#fbf8f4] shadow-2xl transform -translate-x-full transition duration-300">
        <div class="flex items-center justify-between px-7 py-6 border-b border-[#eadfd3]">
            <h2 class="text-2xl font-semibold tracking-[0.12em] uppercase">Menu</h2>
            <button onclick="closeMobileMenu()" class="w-10 h-10 flex items-center justify-center text-3xl">×</button>
        </div>

        <div class="px-5 py-6 space-y-5 border-b border-[#eadfd3]">
            <a href="{{ url('/') }}" class="block text-xl font-semibold tracking-[0.18em] uppercase">Home</a>
            <a href="{{ url('collection') }}" class="block text-xl font-semibold tracking-[0.18em] uppercase">Shop</a>
            <a href="{{ url('about') }}" class="block text-xl font-semibold tracking-[0.18em] uppercase">About</a>
            <a href="{{ url('contact') }}" class="block text-xl font-semibold tracking-[0.18em] uppercase">Contact</a>
            <a href="{{ url('cart') }}" class="block text-xl font-semibold tracking-[0.18em] uppercase">Cart</a>
            <a href="{{ url('my-orders') }}" class="block text-xl font-semibold tracking-[0.18em] uppercase text-[#7a4d2a]">My Orders</a>
        </div>

        <div class="px-5 py-6">
            @auth
                <div>
                    <p class="text-xs uppercase tracking-[0.2em] text-[#8b7462]">Signed in as</p>
                    <p class="mt-2 text-lg font-semibold text-[#1b0d03]">{{ Auth::user()->name }}</p>

                    <a href="{{ url('my-orders') }}" class="block mt-4 text-sm text-[#7a4d2a]">
                        My Orders
                    </a>

                    <form action="{{ url('logout') }}" method="post" class="mt-3">
                        @csrf
                        <button class="text-sm text-red-600">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ url('login') }}" class="flex items-center gap-5">
                    <span class="w-12 h-12 rounded-full bg-white shadow-md flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0" />
                        </svg>
                    </span>
                    <span class="text-base font-medium">Login Register</span>
                </a>
            @endauth
        </div>
    </div>
</div>

<main>

    <!-- SUCCESS HERO -->
    <section class="relative px-4 sm:px-6 lg:px-14 pt-8 sm:pt-10 pb-10 overflow-hidden">
        <div class="absolute -top-24 -right-24 w-80 sm:w-96 h-80 sm:h-96 bg-[#bfe8c7]/60 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 bg-white/80 rounded-full blur-3xl"></div>

        <div class="relative overflow-hidden bg-[#fbf8f4] border border-[#eadfd3]">
            <div class="absolute inset-0 opacity-10">
                <img 
                    src="https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=1600&q=80"
                    class="w-full h-full object-cover object-center"
                    alt="Order Success"
                >
            </div>

            <div class="relative px-5 sm:px-8 lg:px-12 py-12 sm:py-16 lg:py-20 text-center">

                <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-green-100 text-green-700 border border-green-200 flex items-center justify-center mx-auto text-4xl sm:text-5xl shadow-xl shadow-green-900/5 mb-8">
                    ✓
                </div>

                <p class="text-xs uppercase tracking-[0.35em] text-[#8b7462] mb-4">
                    Order Confirmed
                </p>

                <h1 class="text-4xl sm:text-5xl lg:text-7xl font-semibold leading-tight tracking-tight max-w-5xl mx-auto">
                    Thank You For Your Order
                </h1>

                <p class="mt-6 text-sm sm:text-base text-[#2f251e]/70 leading-7 max-w-2xl mx-auto">
                    Your order has been placed successfully. You can view details, track status, and manage your purchase anytime from My Orders.
                </p>

                <div class="mt-9 flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ url('my-orders/'.$order->id) }}"
                    class="w-full sm:w-auto inline-flex justify-center bg-[#1b0d03] text-white px-8 py-4 uppercase tracking-[0.16em] text-xs font-semibold hover:bg-black transition">
                        Track My Order
                    </a>

                    <a href="{{ url('collection') }}"
                       class="w-full sm:w-auto inline-flex justify-center border border-[#1b0d03] text-[#1b0d03] px-8 py-4 uppercase tracking-[0.16em] text-xs font-semibold hover:bg-[#1b0d03] hover:text-white transition">
                        Continue Shopping
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- ORDER QUICK INFO -->
    <section class="px-4 sm:px-6 lg:px-14 pb-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 sm:gap-5">

            <div class="bg-[#fbf8f4] border border-[#eadfd3] p-5 sm:p-6">
                <p class="text-xs uppercase tracking-[0.25em] text-[#8b7462]">
                    Order No
                </p>
                <h3 class="mt-3 text-lg sm:text-xl font-semibold break-all">
                    {{ $order->order_number }}
                </h3>
            </div>

            <div class="bg-[#1b0d03] text-white p-5 sm:p-6">
                <p class="text-xs uppercase tracking-[0.25em] text-[#e8c7ad]">
                    Grand Total
                </p>
                <h3 class="mt-3 text-2xl sm:text-3xl font-semibold">
                    ₹{{ $order->total_amount }}
                </h3>
            </div>

            <div class="bg-[#fbf8f4] border border-[#eadfd3] p-5 sm:p-6">
                <p class="text-xs uppercase tracking-[0.25em] text-[#8b7462]">
                    Payment
                </p>
                <h3 class="mt-3 text-xl sm:text-2xl font-semibold break-words">
                    {{ ucfirst($order->payment_method) }}
                </h3>
            </div>

            <div class="bg-[#fbf8f4] border border-[#eadfd3] p-5 sm:p-6">
                <p class="text-xs uppercase tracking-[0.25em] text-[#8b7462]">
                    Status
                </p>

                <span class="mt-3 inline-flex items-center gap-2 px-4 py-2 text-xs uppercase tracking-[0.14em] font-semibold
                    @if($order->order_status == 'delivered') bg-green-100 text-green-700
                    @elseif($order->order_status == 'cancelled') bg-red-100 text-red-700
                    @elseif($order->order_status == 'shipped') bg-blue-100 text-blue-700
                    @elseif($order->order_status == 'confirmed') bg-purple-100 text-purple-700
                    @elseif($order->order_status == 'pending') bg-yellow-100 text-yellow-700
                    @else bg-[#fff2e5] text-[#7a4d2a]
                    @endif">

                    <span class="w-2 h-2 rounded-full
                        @if($order->order_status == 'delivered') bg-green-600
                        @elseif($order->order_status == 'cancelled') bg-red-600
                        @elseif($order->order_status == 'shipped') bg-blue-600
                        @elseif($order->order_status == 'confirmed') bg-purple-600
                        @elseif($order->order_status == 'pending') bg-yellow-600
                        @else bg-[#7a4d2a]
                        @endif">
                    </span>

                    {{ ucfirst($order->order_status) }}
                </span>
            </div>

        </div>
    </section>

    <!-- ORDER MAIN CONTENT -->
    <section class="px-4 sm:px-6 lg:px-14 pb-16 lg:pb-24">

        <div class="grid grid-cols-1 xl:grid-cols-[1fr_390px] gap-8 xl:gap-10 items-start">

            <!-- LEFT SIDE -->
            <div class="space-y-6">

                <!-- ORDER ITEMS -->
                <div class="bg-[#fbf8f4] border border-[#eadfd3] p-5 sm:p-6 lg:p-7">
                    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-7">
                        <div>
                            <p class="text-xs uppercase tracking-[0.28em] text-[#8b7462] mb-3">
                                Order Items
                            </p>

                            <h2 class="text-3xl sm:text-4xl font-semibold">
                                Your Purchase
                            </h2>
                        </div>

                        <p class="text-sm text-[#2f251e]/60">
                            {{ $order->items->count() }} item(s)
                        </p>
                    </div>

                    <div class="hidden md:grid grid-cols-[1.35fr_0.45fr_0.45fr_0.55fr] gap-5 border-y border-[#eadfd3] px-1 py-4 mb-5 text-xs uppercase tracking-[0.22em] text-[#8b7462]">
                        <p>Product</p>
                        <p>Price</p>
                        <p>Qty</p>
                        <p class="text-right">Subtotal</p>
                    </div>

                    <div class="space-y-5">
                        @foreach($order->items as $item)
                            <div class="group bg-[#fffdfb] border border-[#eadfd3] p-4 sm:p-5 hover:shadow-xl hover:shadow-black/5 transition">

                                <div class="grid grid-cols-1 md:grid-cols-[1.35fr_0.45fr_0.45fr_0.55fr] gap-5 md:items-center">

                                    <div class="grid grid-cols-[92px_1fr] sm:grid-cols-[124px_1fr] gap-4 sm:gap-5 items-start">
                                        <div class="overflow-hidden bg-[#eee6dc]">
                                            <img 
                                                src="{{ asset('uploads/products/'.$item->product_image) }}"
                                                class="w-full h-32 sm:h-40 object-cover object-center group-hover:scale-[1.04] transition duration-700"
                                                alt="{{ $item->product_name }}"
                                            >
                                        </div>

                                        <div class="min-w-0">
                                            <p class="text-[10px] uppercase tracking-[0.24em] text-[#8b7462] mb-2">
                                                Viora Select
                                            </p>

                                            <h3 class="text-lg sm:text-xl font-semibold leading-snug">
                                                {{ $item->product_name }}
                                            </h3>

                                            <p class="mt-2 text-sm leading-6 text-[#2f251e]/60">
                                                Your selected premium fashion item has been confirmed.
                                            </p>
                                        </div>
                                    </div>

                                    <div>
                                        <p class="md:hidden text-xs uppercase tracking-[0.2em] text-[#8b7462] mb-2">
                                            Price
                                        </p>

                                        <p class="text-base font-semibold">
                                            ₹{{ $item->price }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="md:hidden text-xs uppercase tracking-[0.2em] text-[#8b7462] mb-2">
                                            Quantity
                                        </p>

                                        <span class="inline-flex items-center justify-center min-w-11 h-11 bg-[#f6f1ea] border border-[#eadfd3] text-sm font-semibold">
                                            {{ $item->quantity }}
                                        </span>
                                    </div>

                                    <div class="md:text-right">
                                        <p class="md:hidden text-xs uppercase tracking-[0.2em] text-[#8b7462] mb-2">
                                            Subtotal
                                        </p>

                                        <p class="text-lg font-semibold text-[#1b0d03]">
                                            ₹{{ $item->subtotal }}
                                        </p>
                                    </div>

                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- MOBILE SHIPPING CARD -->
                <div class="xl:hidden bg-[#fbf8f4] border border-[#eadfd3] p-5 sm:p-6">
                    <p class="text-xs uppercase tracking-[0.28em] text-[#8b7462] mb-3">
                        Delivery Details
                    </p>

                    <h2 class="text-3xl font-semibold mb-5">
                        Shipping Address
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                        <div class="bg-white border border-[#eadfd3] p-4">
                            <p class="text-xs uppercase tracking-[0.18em] text-[#8b7462] mb-2">Customer</p>
                            <p class="font-semibold">{{ $order->full_name }}</p>
                        </div>

                        <div class="bg-white border border-[#eadfd3] p-4">
                            <p class="text-xs uppercase tracking-[0.18em] text-[#8b7462] mb-2">Phone</p>
                            <p class="font-semibold">{{ $order->phone }}</p>
                        </div>

                        <div class="bg-white border border-[#eadfd3] p-4 sm:col-span-2">
                            <p class="text-xs uppercase tracking-[0.18em] text-[#8b7462] mb-2">Address</p>
                            <p class="leading-7 text-[#2f251e]/70">
                                {{ $order->address }}, {{ $order->city }}, {{ $order->state }} - {{ $order->pincode }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- RIGHT SUMMARY -->
            <aside class="bg-[#1b0d03] text-white p-6 sm:p-8 lg:p-9 h-fit xl:sticky xl:top-8">

                <p class="text-xs uppercase tracking-[0.35em] text-[#e8c7ad] mb-4">
                    Confirmation
                </p>

                <h2 class="text-3xl sm:text-4xl font-semibold leading-tight">
                    Order Summary
                </h2>

                <div class="mt-8 space-y-5 border-b border-white/10 pb-7">
                    <div class="flex items-center justify-between gap-4">
                        <span class="text-white/60">Order Total</span>
                        <span class="font-semibold">₹{{ $order->total_amount }}</span>
                    </div>

                    <div class="flex items-center justify-between gap-4">
                        <span class="text-white/60">Payment</span>
                        <span class="font-semibold text-right">{{ ucfirst($order->payment_method) }}</span>
                    </div>

                    <div class="flex items-center justify-between gap-4">
                        <span class="text-white/60">Items</span>
                        <span class="font-semibold">{{ $order->items->count() }}</span>
                    </div>

                    <div class="flex items-center justify-between gap-4">
                        <span class="text-white/60">Shipping</span>
                        <span class="font-semibold text-[#e8c7ad]">Free</span>
                    </div>

                    <div class="flex items-center justify-between gap-4">
                        <span class="text-white/60">Status</span>
                        <span class="font-semibold
                            @if($order->order_status == 'delivered') text-green-300
                            @elseif($order->order_status == 'cancelled') text-red-300
                            @elseif($order->order_status == 'shipped') text-blue-300
                            @elseif($order->order_status == 'pending') text-yellow-300
                            @else text-[#e8c7ad]
                            @endif">
                            {{ ucfirst($order->order_status) }}
                        </span>
                    </div>
                </div>

                <div class="hidden xl:block mt-7 border-b border-white/10 pb-7">
                    <h3 class="font-semibold text-xl mb-4">
                        Shipping Address
                    </h3>

                    <p class="text-sm leading-7 text-white/70">
                        <span class="text-white font-semibold">{{ $order->full_name }}</span> <br>
                        {{ $order->phone }} <br>
                        {{ $order->address }}, {{ $order->city }}, {{ $order->state }} - {{ $order->pincode }}
                    </p>
                </div>

                <div class="mt-7 space-y-5">
                    <div class="flex items-start gap-4">
                        <span class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center shrink-0">✓</span>
                        <div>
                            <h4 class="font-semibold">Order Placed</h4>
                            <p class="mt-1 text-sm text-white/60 leading-6">
                                Your order has been confirmed successfully.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <span class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center shrink-0">⛟</span>
                        <div>
                            <h4 class="font-semibold">Delivery Processing</h4>
                            <p class="mt-1 text-sm text-white/60 leading-6">
                                Your items will be prepared for dispatch soon.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <span class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center shrink-0">?</span>
                        <div>
                            <h4 class="font-semibold">Support Available</h4>
                            <p class="mt-1 text-sm text-white/60 leading-6">
                                Contact support anytime for order-related help.
                            </p>
                        </div>
                    </div>
                </div>

                <a href="{{ url('my-orders') }}"
                   class="mt-8 w-full inline-flex justify-center bg-[#e8c7ad] text-[#1b0d03] px-6 py-4 uppercase tracking-[0.16em] text-xs font-semibold hover:bg-white transition">
                    My Orders
                </a>

                <a href="{{ url('collection') }}"
                   class="mt-4 w-full inline-flex items-center justify-center border border-white/20 text-white px-6 py-4 uppercase tracking-[0.16em] text-xs font-semibold hover:bg-white hover:text-[#1b0d03] transition">
                    Continue Shopping
                </a>

            </aside>

        </div>

    </section>

    <!-- SUCCESS CTA -->
    <section class="relative bg-[#1b0d03] text-white px-4 sm:px-6 lg:px-14 py-16 sm:py-20 lg:py-24 overflow-hidden">
        <div class="absolute inset-0 opacity-25">
            <img 
                src="https://images.unsplash.com/photo-1529139574466-a303027c1d8b?auto=format&fit=crop&w=1600&q=80"
                class="w-full h-full object-cover object-center"
                alt="Viora Success CTA"
            >
        </div>

        <div class="absolute inset-0 bg-gradient-to-r from-[#1b0d03] via-[#1b0d03]/85 to-[#1b0d03]/40"></div>

        <div class="relative grid grid-cols-1 lg:grid-cols-[1.1fr_0.9fr] gap-10 lg:gap-16 items-center">
            <div>
                <p class="text-xs uppercase tracking-[0.35em] text-[#e8c7ad] mb-5">
                    Thank You
                </p>

                <h2 class="text-4xl sm:text-5xl lg:text-6xl font-semibold leading-tight max-w-4xl">
                    Your Style Journey Continues With Viora
                </h2>

                <p class="mt-6 text-sm sm:text-base leading-7 text-white/70 max-w-2xl">
                    Explore more premium pieces and complete your wardrobe with refined styles made for modern everyday fashion.
                </p>

                <div class="mt-9 flex flex-col sm:flex-row gap-4">
                    <a href="{{ url('collection') }}"
                       class="inline-flex items-center justify-center bg-[#e8c7ad] text-[#1b0d03] px-8 py-4 uppercase tracking-[0.14em] text-xs font-semibold hover:bg-white transition">
                        Explore Collection
                    </a>

                    <a href="{{ url('contact') }}"
                       class="inline-flex items-center justify-center border border-white/30 text-white px-8 py-4 uppercase tracking-[0.14em] text-xs font-semibold hover:bg-white hover:text-[#1b0d03] transition">
                        Need Help?
                    </a>
                </div>
            </div>

            <div class="bg-white/10 backdrop-blur-md border border-white/15 p-6 sm:p-8 lg:p-10">
                <p class="text-xs uppercase tracking-[0.3em] text-[#e8c7ad] mb-6">
                    What Happens Next
                </p>

                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <span class="w-11 h-11 rounded-full bg-[#e8c7ad] text-[#1b0d03] flex items-center justify-center shrink-0 font-semibold">
                            01
                        </span>
                        <div>
                            <h4 class="font-semibold text-lg">Order Review</h4>
                            <p class="mt-1 text-sm leading-6 text-white/65">
                                Your order details are saved and ready for processing.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <span class="w-11 h-11 rounded-full bg-[#e8c7ad] text-[#1b0d03] flex items-center justify-center shrink-0 font-semibold">
                            02
                        </span>
                        <div>
                            <h4 class="font-semibold text-lg">Packing</h4>
                            <p class="mt-1 text-sm leading-6 text-white/65">
                                Your selected fashion pieces will be packed carefully.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <span class="w-11 h-11 rounded-full bg-[#e8c7ad] text-[#1b0d03] flex items-center justify-center shrink-0 font-semibold">
                            03
                        </span>
                        <div>
                            <h4 class="font-semibold text-lg">Delivery</h4>
                            <p class="mt-1 text-sm leading-6 text-white/65">
                                You can check delivery updates from your My Orders page.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<!-- FOOTER -->
<footer class="bg-[#14100e] text-white">
    <div class="px-4 sm:px-6 lg:px-14 py-12 sm:py-14">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">

            <div>
                <h4 class="text-3xl font-semibold tracking-[0.15em] uppercase">Viora</h4>
                <p class="mt-4 text-sm text-white/60 leading-6">
                    Modern fashion for men, women and kids — premium, refined and designed for effortless everyday style.
                </p>
            </div>

            <div>
                <h5 class="font-semibold uppercase tracking-[0.15em] text-sm">Shop</h5>
                <div class="mt-5 space-y-3 text-sm text-white/60">
                    <a href="{{ url('collection') }}" class="block hover:text-white">All Collection</a>
                    <a href="{{ url('cart') }}" class="block hover:text-white">Cart</a>
                    <a href="{{ url('my-orders') }}" class="block hover:text-white">My Orders</a>
                </div>
            </div>

            <div>
                <h5 class="font-semibold uppercase tracking-[0.15em] text-sm">Support</h5>
                <div class="mt-5 space-y-3 text-sm text-white/60">
                    <a href="{{ url('contact') }}" class="block hover:text-white">Contact Us</a>
                    <a href="#" class="block hover:text-white">Shipping Info</a>
                    <a href="#" class="block hover:text-white">Returns</a>
                    <a href="#" class="block hover:text-white">Size Guide</a>
                </div>
            </div>

            <div>
                <h5 class="font-semibold uppercase tracking-[0.15em] text-sm">Company</h5>
                <div class="mt-5 space-y-3 text-sm text-white/60">
                    <a href="{{ url('about') }}" class="block hover:text-white">About</a>
                    <a href="#" class="block hover:text-white">Careers</a>
                    <a href="#" class="block hover:text-white">Blog</a>
                    <a href="#" class="block hover:text-white">Privacy Policy</a>
                </div>
            </div>

        </div>

        <div class="border-t border-white/10 mt-10 sm:mt-12 pt-6 flex flex-col sm:flex-row justify-between gap-4 text-xs text-white/40">
            <p>© 2026 Viora. All rights reserved.</p>
            <div class="flex flex-wrap gap-5">
                <a href="#" class="hover:text-white">Terms</a>
                <a href="#" class="hover:text-white">Privacy Policy</a>
                <a href="#" class="hover:text-white">Cookie Policy</a>
            </div>
        </div>
    </div>
</footer>

<script>
    function toggleProfileMenu() {
        const menu = document.getElementById('profileMenu');
        if (menu) {
            menu.classList.toggle('hidden');
        }
    }

    function openMobileMenu() {
        const overlay = document.getElementById('mobileMenuOverlay');
        const drawer = document.getElementById('mobileDrawer');

        overlay.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');

        setTimeout(() => {
            drawer.classList.remove('-translate-x-full');
        }, 10);
    }

    function closeMobileMenu() {
        const overlay = document.getElementById('mobileMenuOverlay');
        const drawer = document.getElementById('mobileDrawer');

        drawer.classList.add('-translate-x-full');

        setTimeout(() => {
            overlay.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }, 300);
    }

    document.addEventListener('click', function(event) {
        const profileMenu = document.getElementById('profileMenu');

        if (
            profileMenu &&
            !event.target.closest('#profileMenu') &&
            !event.target.closest('button[onclick="toggleProfileMenu()"]')
        ) {
            profileMenu.classList.add('hidden');
        }
    });
</script>

</body>
</html>