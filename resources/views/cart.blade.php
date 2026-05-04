<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | Viora</title>
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
            <a href="{{ url('cart') }}" class="block text-xl font-semibold tracking-[0.18em] uppercase text-[#7a4d2a]">Cart</a>
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

    <!-- CART HERO -->
    <section class="relative px-4 sm:px-6 lg:px-14 pt-8 sm:pt-10 pb-10 overflow-hidden">
        <div class="absolute -top-20 -right-20 w-80 h-80 bg-[#ead2ba]/60 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 bg-white/80 rounded-full blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8 border-b border-[#eadfd3] pb-10">
            <div>
                <p class="text-xs uppercase tracking-[0.35em] text-[#8b7462] mb-4">
                    Shopping Bag
                </p>

                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-semibold leading-tight tracking-tight">
                    Your Cart
                </h1>

                <p class="mt-5 max-w-2xl text-sm sm:text-base leading-7 text-[#2f251e]/70">
                    Review your selected Viora pieces, update quantities, and continue toward checkout with a smooth premium shopping experience.
                </p>
            </div>

            <a href="{{ url('collection') }}"
               class="inline-flex items-center justify-center bg-[#1b0d03] text-white px-7 py-4 uppercase tracking-[0.16em] text-xs font-semibold hover:bg-black transition w-fit">
                Continue Shopping
            </a>
        </div>
    </section>

    <section class="px-4 sm:px-6 lg:px-14 pb-16 lg:pb-24">

        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-200 text-green-700 px-5 py-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-100 border border-red-200 text-red-700 px-5 py-4">
                {{ session('error') }}
            </div>
        @endif

        @if($cartItems->count() > 0)

            <div class="grid grid-cols-1 xl:grid-cols-[1fr_390px] gap-8 xl:gap-10 items-start">

                <!-- CART ITEMS -->
                <div class="space-y-5">

                    <div class="hidden md:grid grid-cols-[1.4fr_0.55fr_0.55fr_0.45fr] gap-5 bg-[#fbf8f4] border border-[#eadfd3] px-6 py-4 text-xs uppercase tracking-[0.22em] text-[#8b7462]">
                        <p>Product</p>
                        <p>Quantity</p>
                        <p class="text-right">Subtotal</p>
                        <p class="text-right">Action</p>
                    </div>

                    @foreach($cartItems as $item)
                        @php
                            $price = $item->product->getRawOriginal('price');
                            $subtotal = $price * $item->quantity;
                        @endphp

                        <div class="group bg-[#fbf8f4] border border-[#eadfd3] p-4 sm:p-5 lg:p-6 hover:shadow-xl hover:shadow-black/5 transition">

                            <div class="grid grid-cols-1 md:grid-cols-[1.4fr_0.55fr_0.55fr_0.45fr] gap-5 md:items-center">

                                <!-- PRODUCT -->
                                <div class="grid grid-cols-[96px_1fr] sm:grid-cols-[124px_1fr] gap-4 sm:gap-5 items-start">
                                    <a href="{{ url('product/'.$item->product->id) }}" class="block overflow-hidden bg-[#eee6dc]">
                                        <img 
                                            src="{{ asset('uploads/products/'.$item->product->image) }}" 
                                            class="w-full h-32 sm:h-40 object-cover object-center group-hover:scale-[1.04] transition duration-700"
                                            alt="{{ $item->product->name }}"
                                        >
                                    </a>

                                    <div class="min-w-0">
                                        <p class="text-[10px] uppercase tracking-[0.24em] text-[#8b7462] mb-2">
                                            Viora Select
                                        </p>

                                        <a href="{{ url('product/'.$item->product->id) }}" class="block">
                                            <h3 class="text-lg sm:text-xl font-semibold leading-snug hover:text-[#7a4d2a] transition">
                                                {{ $item->product->name }}
                                            </h3>
                                        </a>

                                        <p class="mt-2 text-sm leading-6 text-[#2f251e]/60 line-clamp-2">
                                            {{ $item->product->short_description ?? \Illuminate\Support\Str::limit($item->product->description, 70) }}
                                        </p>

                                        <p class="mt-3 text-base font-semibold">
                                            {{ $item->product->price }}
                                        </p>

                                        <p class="mt-1 text-xs text-[#8b7462]">
                                            Available stock: {{ $item->product->stock }}
                                        </p>
                                    </div>
                                </div>

                                <!-- QUANTITY -->
                                <div>
                                    <p class="md:hidden text-xs uppercase tracking-[0.2em] text-[#8b7462] mb-3">
                                        Quantity
                                    </p>

                                    <form action="{{ url('cart/update/'.$item->id) }}" method="post">
                                        @csrf
                                        @method('PUT')

                                        <div class="flex items-center gap-3">
                                            <input 
                                                type="number" 
                                                name="quantity" 
                                                value="{{ $item->quantity }}"
                                                min="1"
                                                max="{{ $item->product->stock }}"
                                                class="w-20 border border-[#eadfd3] bg-white px-3 py-3 outline-none focus:border-[#1b0d03]"
                                            >

                                            <button class="bg-[#1b0d03] text-white px-4 py-3 text-[10px] uppercase tracking-[0.14em] hover:bg-black transition">
                                                Update
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <!-- SUBTOTAL -->
                                <div class="md:text-right">
                                    <p class="md:hidden text-xs uppercase tracking-[0.2em] text-[#8b7462] mb-2">
                                        Subtotal
                                    </p>

                                    <p class="text-lg font-semibold text-[#1b0d03]">
                                        ₹{{ $subtotal }}
                                    </p>
                                </div>

                                <!-- REMOVE -->
                                <div class="md:text-right">
                                    <a href="{{ url('cart/remove/'.$item->id) }}"
                                       class="inline-flex items-center justify-center border border-red-200 text-red-600 px-4 py-3 text-[10px] uppercase tracking-[0.14em] hover:bg-red-50 transition">
                                        Remove
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>

                <!-- ORDER SUMMARY -->
                <aside class="bg-[#1b0d03] text-white p-6 sm:p-8 lg:p-9 h-fit xl:sticky xl:top-8">

                    <p class="text-xs uppercase tracking-[0.35em] text-[#e8c7ad] mb-4">
                        Order Summary
                    </p>

                    <h2 class="text-3xl sm:text-4xl font-semibold leading-tight">
                        Your Selection
                    </h2>

                    <div class="mt-8 space-y-5 border-b border-white/10 pb-7">
                        <div class="flex items-center justify-between gap-4">
                            <span class="text-white/60">Items</span>
                            <span class="font-semibold">{{ $cartItems->count() }}</span>
                        </div>

                        <div class="flex items-center justify-between gap-4">
                            <span class="text-white/60">Subtotal</span>
                            <span class="font-semibold">₹{{ $grandTotal }}</span>
                        </div>

                        <div class="flex items-center justify-between gap-4">
                            <span class="text-white/60">Shipping</span>
                            <span class="font-semibold text-[#e8c7ad]">Free</span>
                        </div>

                        <div class="flex items-center justify-between gap-4">
                            <span class="text-white/60">Estimated Tax</span>
                            <span class="font-semibold">Calculated later</span>
                        </div>
                    </div>

                    <div class="flex items-end justify-between gap-4 mt-7">
                        <div>
                            <p class="text-xs uppercase tracking-[0.24em] text-white/50">
                                Grand Total
                            </p>
                            <p class="mt-2 text-3xl font-semibold">
                                ₹{{ $grandTotal }}
                            </p>
                        </div>
                    </div>

                    <a href="{{ url('checkout') }}"
                    class="mt-8 w-full inline-flex justify-center bg-[#e8c7ad] text-[#1b0d03] px-6 py-4 uppercase tracking-[0.16em] text-xs font-semibold hover:bg-white transition">
                        Proceed To Checkout
                    </a>

                    <a href="{{ url('collection') }}"
                       class="mt-4 w-full inline-flex items-center justify-center border border-white/20 text-white px-6 py-4 uppercase tracking-[0.16em] text-xs font-semibold hover:bg-white hover:text-[#1b0d03] transition">
                        Add More Items
                    </a>

                    <div class="mt-8 space-y-5 border-t border-white/10 pt-7">
                        <div class="flex items-start gap-4">
                            <span class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center shrink-0">✓</span>
                            <div>
                                <h4 class="font-semibold">Secure Checkout</h4>
                                <p class="mt-1 text-sm text-white/60 leading-6">
                                    Your checkout process will be safe and smooth.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <span class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center shrink-0">⛟</span>
                            <div>
                                <h4 class="font-semibold">Fast Delivery</h4>
                                <p class="mt-1 text-sm text-white/60 leading-6">
                                    Quick dispatch support across selected locations.
                                </p>
                            </div>
                        </div>
                    </div>

                </aside>

            </div>

        @else

            <!-- EMPTY CART -->
            <div class="relative overflow-hidden bg-[#fbf8f4] border border-[#eadfd3] min-h-[520px] flex items-center justify-center p-6 sm:p-10">
                <div class="absolute inset-0 opacity-15">
                    <img 
                        src="https://images.unsplash.com/photo-1529139574466-a303027c1d8b?auto=format&fit=crop&w=1600&q=80"
                        class="w-full h-full object-cover"
                        alt="Empty Cart"
                    >
                </div>

                <div class="relative max-w-2xl mx-auto text-center">
                    <p class="text-xs uppercase tracking-[0.35em] text-[#8b7462] mb-5">
                        Empty Bag
                    </p>

                    <h2 class="text-4xl sm:text-5xl lg:text-6xl font-semibold leading-tight">
                        Your Cart Feels A Little Empty
                    </h2>

                    <p class="mt-5 text-sm sm:text-base leading-7 text-[#2f251e]/70">
                        Discover premium Viora styles and add your favorite pieces to begin your shopping journey.
                    </p>

                    <a href="{{ url('collection') }}"
                       class="mt-8 inline-flex bg-[#1b0d03] text-white px-8 py-4 uppercase tracking-[0.16em] text-xs font-semibold hover:bg-black transition">
                        Start Shopping
                    </a>
                </div>
            </div>

        @endif

    </section>

    <!-- CART CTA -->
    <section class="relative bg-[#1b0d03] text-white px-4 sm:px-6 lg:px-14 py-16 sm:py-20 lg:py-24 overflow-hidden">
        <div class="absolute inset-0 opacity-25">
            <img 
                src="https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=1600&q=80"
                class="w-full h-full object-cover object-center"
                alt="Viora Cart CTA"
            >
        </div>

        <div class="absolute inset-0 bg-gradient-to-r from-[#1b0d03] via-[#1b0d03]/85 to-[#1b0d03]/40"></div>

        <div class="relative grid grid-cols-1 lg:grid-cols-[1.1fr_0.9fr] gap-10 lg:gap-16 items-center">
            <div>
                <p class="text-xs uppercase tracking-[0.35em] text-[#e8c7ad] mb-5">
                    Complete Your Wardrobe
                </p>

                <h2 class="text-4xl sm:text-5xl lg:text-6xl font-semibold leading-tight max-w-4xl">
                    Add More Pieces That Match Your Style
                </h2>

                <p class="mt-6 text-sm sm:text-base leading-7 text-white/70 max-w-2xl">
                    Explore more refined essentials from Viora and build a wardrobe that feels modern, confident, and effortless.
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
                    Viora Promise
                </p>

                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <span class="w-11 h-11 rounded-full bg-[#e8c7ad] text-[#1b0d03] flex items-center justify-center shrink-0 font-semibold">
                            01
                        </span>
                        <div>
                            <h4 class="font-semibold text-lg">Premium Fashion</h4>
                            <p class="mt-1 text-sm leading-6 text-white/65">
                                Modern pieces selected for comfort, polish, and everyday styling.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <span class="w-11 h-11 rounded-full bg-[#e8c7ad] text-[#1b0d03] flex items-center justify-center shrink-0 font-semibold">
                            02
                        </span>
                        <div>
                            <h4 class="font-semibold text-lg">Easy Shopping</h4>
                            <p class="mt-1 text-sm leading-6 text-white/65">
                                Smooth browsing, simple cart updates, and quick checkout flow.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <span class="w-11 h-11 rounded-full bg-[#e8c7ad] text-[#1b0d03] flex items-center justify-center shrink-0 font-semibold">
                            03
                        </span>
                        <div>
                            <h4 class="font-semibold text-lg">Reliable Support</h4>
                            <p class="mt-1 text-sm leading-6 text-white/65">
                                Support for orders, product questions, delivery, and returns.
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