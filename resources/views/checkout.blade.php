<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Viora</title>
    <link rel="icon" type="image/png" href="{{ asset('uploads/product/logo.png') }}?v=2">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#f6f1ea] text-[#160c05] overflow-x-hidden">

<!-- NAVBAR -->
<nav class="relative z-40 w-full px-4 sm:px-6 lg:px-14 py-5">
    <div class="flex items-center justify-between">

        <!-- Logo -->
        <a href="{{ url('/') }}" class="inline-flex items-center">
            <h2 class="text-[#1b0d03] text-xl sm:text-2xl tracking-[0.35em] uppercase font-medium">
                Viora
            </h2>
        </a>

        <!-- Desktop Links -->
        <div class="hidden lg:flex items-center gap-8 text-sm font-medium bg-white/45 backdrop-blur-md border border-white/60 px-5 py-3 rounded-full">
            <a href="{{ url('/') }}" class="hover:text-[#7a4d2a] transition">Home</a>
            <a href="{{ url('collection') }}" class="hover:text-[#7a4d2a] transition">Collection</a>
            <a href="{{ url('about') }}" class="hover:text-[#7a4d2a] transition">About Us</a>
            <a href="{{ url('contact') }}" class="hover:text-[#7a4d2a] transition">Contact Us</a>
        </div>

        <!-- Desktop Icons -->
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
                class="w-11 h-11 rounded-full bg-white/55 backdrop-blur-md border border-black/10 flex items-center justify-center hover:bg-[#1b0d03] hover:text-white transition"
                title="Cart"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 7.5h10.5l-.75 12h-9l-.75-12zM9 7.5a3 3 0 016 0M9.75 11.25h.01M14.25 11.25h.01" />
                </svg>
            </a>
        </div>

        <!-- Mobile Icons -->
        <div class="lg:hidden flex items-center gap-3">
            <a 
                href="{{ url('cart') }}"
                class="w-10 h-10 rounded-full bg-white/60 backdrop-blur-md border border-black/10 flex items-center justify-center"
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
        </div>

        <div class="px-5 py-6">
            @auth
                <div>
                    <p class="text-xs uppercase tracking-[0.2em] text-[#8b7462]">Signed in as</p>
                    <p class="mt-2 text-lg font-semibold text-[#1b0d03]">{{ Auth::user()->name }}</p>

                    <a href="{{ url('my-orders') }}" class="block mt-4 text-sm text-[#8b7462]">
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

    <!-- HERO -->
    <section class="relative px-4 sm:px-6 lg:px-14 pt-8 sm:pt-10 pb-10 overflow-hidden">
        <div class="absolute -top-24 -right-20 w-96 h-96 bg-[#ead2ba]/60 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-white/80 rounded-full blur-3xl"></div>

        <div class="relative border-b border-[#eadfd3] pb-10">
            <a href="{{ url('cart') }}" class="inline-flex items-center gap-2 text-sm text-[#8b7462] hover:text-[#1b0d03] transition mb-7">
                <span>←</span>
                <span>Back to Cart</span>
            </a>

            <div class="grid grid-cols-1 lg:grid-cols-[1fr_420px] gap-8 lg:gap-12 items-end">
                <div>
                    <p class="text-xs uppercase tracking-[0.35em] text-[#8b7462] mb-4">
                        Secure Checkout
                    </p>

                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-semibold leading-tight tracking-tight">
                        Complete Your Order
                    </h1>

                    <p class="mt-5 max-w-2xl text-sm sm:text-base leading-7 text-[#2f251e]/70">
                        Add your delivery details and confirm your order with Cash on Delivery. Your selected Viora pieces are almost ready.
                    </p>
                </div>

                <div class="bg-[#fbf8f4] border border-[#eadfd3] p-5 sm:p-6">
                    <div class="grid grid-cols-3 gap-4 text-center">
                        <div>
                            <p class="text-[10px] uppercase tracking-[0.2em] text-[#8b7462]">Step</p>
                            <p class="mt-2 font-semibold">Checkout</p>
                        </div>

                        <div>
                            <p class="text-[10px] uppercase tracking-[0.2em] text-[#8b7462]">Payment</p>
                            <p class="mt-2 font-semibold">COD</p>
                        </div>

                        <div>
                            <p class="text-[10px] uppercase tracking-[0.2em] text-[#8b7462]">Shipping</p>
                            <p class="mt-2 font-semibold">Free</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CHECKOUT CONTENT -->
    <section class="px-4 sm:px-6 lg:px-14 pb-16 lg:pb-24">

        @if(session('error'))
            <div class="mb-6 bg-red-100 border border-red-200 text-red-700 px-5 py-4">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 bg-red-100 border border-red-200 text-red-700 px-5 py-4">
                <p class="font-semibold mb-2">Please fix the following errors:</p>
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('checkout') }}" method="post">
            @csrf

            <div class="grid grid-cols-1 xl:grid-cols-[1fr_410px] gap-8 xl:gap-10 items-start">

                <!-- LEFT FORM -->
                <div class="space-y-6">

                    <!-- SHIPPING DETAILS -->
                    <div class="bg-[#fbf8f4] border border-[#eadfd3] p-6 sm:p-8 lg:p-10">
                        <div class="flex items-start justify-between gap-4 mb-8">
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-[#8b7462] mb-3">
                                    Delivery Details
                                </p>

                                <h2 class="text-3xl sm:text-4xl font-semibold">
                                    Shipping Information
                                </h2>
                            </div>

                            <span class="hidden sm:flex w-12 h-12 rounded-full bg-[#1b0d03] text-white items-center justify-center font-semibold">
                                01
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">

                            <div>
                                <label class="block text-xs uppercase tracking-[0.22em] text-[#8b7462] mb-3">
                                    Full Name
                                </label>
                                <input 
                                    type="text" 
                                    name="full_name" 
                                    value="{{ old('full_name', Auth::user()->name ?? '') }}"
                                    placeholder="Enter full name"
                                    class="w-full border border-[#eadfd3] bg-white px-4 py-4 outline-none focus:border-[#1b0d03] transition"
                                >
                            </div>

                            <div>
                                <label class="block text-xs uppercase tracking-[0.22em] text-[#8b7462] mb-3">
                                    Email Address
                                </label>
                                <input 
                                    type="email" 
                                    name="email" 
                                    value="{{ old('email', Auth::user()->email ?? '') }}"
                                    placeholder="example@gmail.com"
                                    class="w-full border border-[#eadfd3] bg-white px-4 py-4 outline-none focus:border-[#1b0d03] transition"
                                >
                            </div>

                            <div>
                                <label class="block text-xs uppercase tracking-[0.22em] text-[#8b7462] mb-3">
                                    Phone Number
                                </label>
                                <input 
                                    type="text" 
                                    name="phone" 
                                    value="{{ old('phone') }}"
                                    placeholder="+91 98765 43210"
                                    class="w-full border border-[#eadfd3] bg-white px-4 py-4 outline-none focus:border-[#1b0d03] transition"
                                >
                            </div>

                            <div>
                                <label class="block text-xs uppercase tracking-[0.22em] text-[#8b7462] mb-3">
                                    Pincode
                                </label>
                                <input 
                                    type="text" 
                                    name="pincode" 
                                    value="{{ old('pincode') }}"
                                    placeholder="390001"
                                    class="w-full border border-[#eadfd3] bg-white px-4 py-4 outline-none focus:border-[#1b0d03] transition"
                                >
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-xs uppercase tracking-[0.22em] text-[#8b7462] mb-3">
                                    Full Address
                                </label>
                                <textarea 
                                    name="address" 
                                    rows="4" 
                                    placeholder="House no, street, area, landmark"
                                    class="w-full border border-[#eadfd3] bg-white px-4 py-4 outline-none resize-none focus:border-[#1b0d03] transition"
                                >{{ old('address') }}</textarea>
                            </div>

                            <div>
                                <label class="block text-xs uppercase tracking-[0.22em] text-[#8b7462] mb-3">
                                    City
                                </label>
                                <input 
                                    type="text" 
                                    name="city" 
                                    value="{{ old('city') }}"
                                    placeholder="Vapi"
                                    class="w-full border border-[#eadfd3] bg-white px-4 py-4 outline-none focus:border-[#1b0d03] transition"
                                >
                            </div>

                            <div>
                                <label class="block text-xs uppercase tracking-[0.22em] text-[#8b7462] mb-3">
                                    State
                                </label>
                                <input 
                                    type="text" 
                                    name="state" 
                                    value="{{ old('state') }}"
                                    placeholder="Gujarat"
                                    class="w-full border border-[#eadfd3] bg-white px-4 py-4 outline-none focus:border-[#1b0d03] transition"
                                >
                            </div>

                        </div>
                    </div>

                    <!-- PAYMENT METHOD -->
                    <div class="bg-[#fbf8f4] border border-[#eadfd3] p-6 sm:p-8 lg:p-10">
                        <div class="flex items-start justify-between gap-4 mb-7">
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-[#8b7462] mb-3">
                                    Payment
                                </p>

                                <h2 class="text-3xl sm:text-4xl font-semibold">
                                    Payment Method
                                </h2>
                            </div>

                            <span class="hidden sm:flex w-12 h-12 rounded-full bg-[#1b0d03] text-white items-center justify-center font-semibold">
                                02
                            </span>
                        </div>

                        <label class="group flex items-start gap-4 bg-white border border-[#eadfd3] px-5 py-5 cursor-pointer hover:border-[#1b0d03] transition">
                            <input 
                                type="radio" 
                                name="payment_method" 
                                value="Cash on Delivery" 
                                checked
                                class="mt-1 accent-[#1b0d03]"
                            >

                            <span>
                                <span class="block font-semibold text-[#1b0d03]">
                                    Cash on Delivery
                                </span>
                                <span class="block mt-1 text-sm leading-6 text-[#2f251e]/65">
                                    Pay safely when your order reaches your doorstep.
                                </span>
                            </span>
                        </label>

                        <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="border border-[#eadfd3] bg-[#f6f1ea] p-4">
                                <p class="text-[10px] uppercase tracking-[0.2em] text-[#8b7462]">Payment</p>
                                <p class="mt-2 font-semibold">Cash on Delivery</p>
                            </div>

                            <div class="border border-[#eadfd3] bg-[#f6f1ea] p-4">
                                <p class="text-[10px] uppercase tracking-[0.2em] text-[#8b7462]">Delivery</p>
                                <p class="mt-2 font-semibold">Free Shipping</p>
                            </div>

                            <div class="border border-[#eadfd3] bg-[#f6f1ea] p-4">
                                <p class="text-[10px] uppercase tracking-[0.2em] text-[#8b7462]">Support</p>
                                <p class="mt-2 font-semibold">Easy Help</p>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- RIGHT ORDER SUMMARY -->
                <aside class="bg-[#1b0d03] text-white p-6 sm:p-8 lg:p-9 h-fit xl:sticky xl:top-8">

                    <p class="text-xs uppercase tracking-[0.35em] text-[#e8c7ad] mb-4">
                        Order Summary
                    </p>

                    <h2 class="text-3xl sm:text-4xl font-semibold leading-tight">
                        Your Order
                    </h2>

                    <div class="mt-8 space-y-5 max-h-[370px] overflow-y-auto pr-1">
                        @foreach($cartItems as $item)
                            @php
                                $price = $item->product->getRawOriginal('price');
                                $subtotal = $price * $item->quantity;
                            @endphp

                            <div class="flex gap-4 border-b border-white/10 pb-5">
                                <a href="{{ url('product/'.$item->product->id) }}" class="block shrink-0">
                                    <img 
                                        src="{{ asset('uploads/products/'.$item->product->image) }}"
                                        class="w-16 h-20 sm:w-20 sm:h-24 object-cover bg-white/10"
                                        alt="{{ $item->product->name }}"
                                    >
                                </a>

                                <div class="flex-1 min-w-0">
                                    <a href="{{ url('product/'.$item->product->id) }}" class="block">
                                        <h4 class="font-semibold text-sm sm:text-base leading-snug hover:text-[#e8c7ad] transition">
                                            {{ $item->product->name }}
                                        </h4>
                                    </a>

                                    <p class="text-xs text-white/50 mt-1">
                                        Qty: {{ $item->quantity }}
                                    </p>

                                    <p class="text-sm sm:text-base mt-2 font-semibold">
                                        ₹{{ $subtotal }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-7 border-t border-white/10 pt-6 space-y-4">
                        <div class="flex justify-between gap-4">
                            <span class="text-white/60">Subtotal</span>
                            <span class="font-semibold">₹{{ $grandTotal }}</span>
                        </div>

                        <div class="flex justify-between gap-4">
                            <span class="text-white/60">Shipping</span>
                            <span class="font-semibold text-[#e8c7ad]">Free</span>
                        </div>

                        <div class="flex justify-between gap-4">
                            <span class="text-white/60">Payment</span>
                            <span class="font-semibold">COD</span>
                        </div>

                        <div class="flex justify-between text-xl sm:text-2xl font-semibold border-t border-white/10 pt-5">
                            <span>Total</span>
                            <span>₹{{ $grandTotal }}</span>
                        </div>
                    </div>

                    <button class="mt-8 w-full bg-[#e8c7ad] text-[#1b0d03] px-6 py-4 uppercase tracking-[0.16em] text-xs font-semibold hover:bg-white transition">
                        Place Order
                    </button>

                    <a href="{{ url('cart') }}"
                       class="mt-4 w-full inline-flex items-center justify-center border border-white/20 text-white px-6 py-4 uppercase tracking-[0.16em] text-xs font-semibold hover:bg-white hover:text-[#1b0d03] transition">
                        Edit Cart
                    </a>

                    <div class="mt-8 border-t border-white/10 pt-7 space-y-5">
                        <div class="flex items-start gap-4">
                            <span class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center shrink-0">
                                ✓
                            </span>
                            <div>
                                <h4 class="font-semibold">Order Protection</h4>
                                <p class="mt-1 text-sm text-white/60 leading-6">
                                    Stock is verified again before your order is created.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <span class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center shrink-0">
                                ⛟
                            </span>
                            <div>
                                <h4 class="font-semibold">Fast Dispatch</h4>
                                <p class="mt-1 text-sm text-white/60 leading-6">
                                    Your order will be prepared after confirmation.
                                </p>
                            </div>
                        </div>
                    </div>

                </aside>

            </div>
        </form>

    </section>

    <!-- CHECKOUT CTA -->
    <section class="relative bg-[#1b0d03] text-white px-4 sm:px-6 lg:px-14 py-16 sm:py-20 lg:py-24 overflow-hidden">
        <div class="absolute inset-0 opacity-25">
            <img 
                src="https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=1600&q=80"
                class="w-full h-full object-cover object-center"
                alt="Viora Checkout"
            >
        </div>

        <div class="absolute inset-0 bg-gradient-to-r from-[#1b0d03] via-[#1b0d03]/85 to-[#1b0d03]/40"></div>

        <div class="relative grid grid-cols-1 lg:grid-cols-[1.1fr_0.9fr] gap-10 lg:gap-16 items-center">
            <div>
                <p class="text-xs uppercase tracking-[0.35em] text-[#e8c7ad] mb-5">
                    Almost There
                </p>

                <h2 class="text-4xl sm:text-5xl lg:text-6xl font-semibold leading-tight max-w-4xl">
                    Your Viora Style Is One Step Away
                </h2>

                <p class="mt-6 text-sm sm:text-base leading-7 text-white/70 max-w-2xl">
                    Confirm your delivery details and place your order. We will prepare your selected pieces with care.
                </p>
            </div>

            <div class="bg-white/10 backdrop-blur-md border border-white/15 p-6 sm:p-8 lg:p-10">
                <p class="text-xs uppercase tracking-[0.3em] text-[#e8c7ad] mb-6">
                    Checkout Promise
                </p>

                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <span class="w-11 h-11 rounded-full bg-[#e8c7ad] text-[#1b0d03] flex items-center justify-center shrink-0 font-semibold">
                            01
                        </span>
                        <div>
                            <h4 class="font-semibold text-lg">Simple COD</h4>
                            <p class="mt-1 text-sm leading-6 text-white/65">
                                Pay comfortably when the order is delivered.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <span class="w-11 h-11 rounded-full bg-[#e8c7ad] text-[#1b0d03] flex items-center justify-center shrink-0 font-semibold">
                            02
                        </span>
                        <div>
                            <h4 class="font-semibold text-lg">Stock Checked</h4>
                            <p class="mt-1 text-sm leading-6 text-white/65">
                                Product availability is verified before order creation.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <span class="w-11 h-11 rounded-full bg-[#e8c7ad] text-[#1b0d03] flex items-center justify-center shrink-0 font-semibold">
                            03
                        </span>
                        <div>
                            <h4 class="font-semibold text-lg">Cart Cleared</h4>
                            <p class="mt-1 text-sm leading-6 text-white/65">
                                After order success, your cart will be cleared automatically.
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