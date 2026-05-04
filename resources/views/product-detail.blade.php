<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} | Viora</title>
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
                <a href="{{ url('collection') }}" class="px-4 py-2 rounded-full bg-[#fff2e5] shadow-sm">Collection</a>
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
                    class="w-11 h-11 rounded-full bg-white/55 backdrop-blur-md border border-black/10 flex items-center justify-center hover:bg-[#1b0d03] hover:text-white transition"
                    title="Cart"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 7.5h10.5l-.75 12h-9l-.75-12zM9 7.5a3 3 0 016 0M9.75 11.25h.01M14.25 11.25h.01" />
                    </svg>
                </a>
            </div>

            <div class="lg:hidden flex items-center gap-3">
                @auth
                    <button 
                        type="button"
                        onclick="openMobileMenu()"
                        class="w-10 h-10 rounded-full bg-white/60 backdrop-blur-md border border-black/10 flex items-center justify-center"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0" />
                        </svg>
                    </button>
                @else
                    <a 
                        href="{{ url('login') }}"
                        class="w-10 h-10 rounded-full bg-white/60 backdrop-blur-md border border-black/10 flex items-center justify-center"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0" />
                        </svg>
                    </a>
                @endauth

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

    <!-- MOBILE MENU -->
    <div id="mobileMenuOverlay" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/45" onclick="closeMobileMenu()"></div>

        <div id="mobileDrawer" class="absolute top-0 left-0 h-full w-[82%] max-w-sm bg-[#fbf8f4] shadow-2xl transform -translate-x-full transition duration-300">
            <div class="flex items-center justify-between px-7 py-6 border-b border-[#eadfd3]">
                <h2 class="text-2xl font-semibold tracking-[0.12em] uppercase">Menu</h2>

                <button onclick="closeMobileMenu()" class="w-10 h-10 flex items-center justify-center text-3xl">
                    ×
                </button>
            </div>

            <div class="px-5 py-6 space-y-5 border-b border-[#eadfd3]">
                <a href="{{ url('/') }}" class="block text-xl font-semibold tracking-[0.18em] uppercase">Home</a>
                <a href="{{ url('collection') }}" class="block text-xl font-semibold tracking-[0.18em] uppercase text-[#7a4d2a]">Shop</a>
                <a href="{{ url('about') }}" class="block text-xl font-semibold tracking-[0.18em] uppercase">About</a>
                <a href="{{ url('contact') }}" class="block text-xl font-semibold tracking-[0.18em] uppercase">Contact</a>
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
        <!-- TOP -->
        <section class="px-4 sm:px-6 lg:px-14 pt-4 sm:pt-6 pb-14 lg:pb-20">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <a href="{{ url('collection') }}" class="inline-flex items-center gap-2 text-sm text-[#8b7462] hover:text-[#1b0d03] transition w-fit">
                    <span>←</span>
                    <span>Back to Collection</span>
                </a>

                <div class="hidden sm:flex items-center gap-2 text-xs uppercase tracking-[0.22em] text-[#8b7462]">
                    <span>Home</span>
                    <span>/</span>
                    <span>Collection</span>
                    <span>/</span>
                    <span class="text-[#1b0d03]">{{ \Illuminate\Support\Str::limit($product->name, 20) }}</span>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-[1.05fr_0.95fr] gap-8 xl:gap-12 items-start">
                
                <!-- IMAGE -->
                <div class="relative">
                    <div class="absolute -top-6 -left-4 sm:-top-8 sm:-left-8 w-40 sm:w-56 h-40 sm:h-56 bg-[#ead3bf] rounded-full blur-3xl opacity-70"></div>
                    <div class="absolute -bottom-6 -right-4 sm:-bottom-10 sm:-right-8 w-44 sm:w-64 h-44 sm:h-64 bg-white rounded-full blur-3xl opacity-90"></div>

                    <div class="relative border border-[#eadfd3] bg-[#fbf8f4] p-3 sm:p-4 lg:p-5">
                        <div class="relative overflow-hidden bg-[#ece2d8] min-h-[420px] sm:min-h-[560px] lg:min-h-[720px]">
                            <img 
                                src="{{ asset('uploads/products/'.$product->image) }}"
                                alt="{{ $product->name }}"
                                class="absolute inset-0 w-full h-full object-cover object-center hover:scale-[1.03] transition duration-700"
                            >

                            <div class="absolute top-4 left-4 sm:top-6 sm:left-6">
                                <span class="bg-white/90 backdrop-blur-md px-4 sm:px-5 py-2 text-[10px] sm:text-[11px] uppercase tracking-[0.24em] text-[#1b0d03]">
                                    Viora Signature
                                </span>
                            </div>

                            <div class="absolute bottom-4 left-4 right-4 sm:bottom-6 sm:left-6 sm:right-6">
                                <div class="bg-[#1b0d03]/90 backdrop-blur-md text-white px-4 sm:px-6 py-4 flex items-center justify-between gap-4">
                                    <div>
                                        <p class="text-[10px] uppercase tracking-[0.24em] text-white/60">Availability</p>
                                        <p class="mt-1 text-sm font-semibold">
                                            {{ $product->stock > 0 ? 'Ready to Wear' : 'Currently Unavailable' }}
                                        </p>
                                    </div>

                                    @if($product->stock > 0)
                                        <span class="w-3 h-3 rounded-full bg-green-400 shrink-0"></span>
                                    @else
                                        <span class="w-3 h-3 rounded-full bg-red-400 shrink-0"></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-3 sm:gap-4 mt-4 sm:mt-5">
                        <div class="bg-[#fbf8f4] border border-[#eadfd3] px-3 py-4 text-center">
                            <p class="text-[10px] uppercase tracking-[0.2em] text-[#8b7462]">Fabric</p>
                            <p class="mt-1 text-sm font-semibold">Premium</p>
                        </div>

                        <div class="bg-[#fbf8f4] border border-[#eadfd3] px-3 py-4 text-center">
                            <p class="text-[10px] uppercase tracking-[0.2em] text-[#8b7462]">Fit</p>
                            <p class="mt-1 text-sm font-semibold">Refined</p>
                        </div>

                        <div class="bg-[#fbf8f4] border border-[#eadfd3] px-3 py-4 text-center">
                            <p class="text-[10px] uppercase tracking-[0.2em] text-[#8b7462]">Delivery</p>
                            <p class="mt-1 text-sm font-semibold">Fast</p>
                        </div>
                    </div>
                </div>

                <!-- DETAILS -->
                <div class="xl:sticky xl:top-8">
                    <div class="bg-[#fbf8f4] border border-[#eadfd3] p-6 sm:p-8 lg:p-10 xl:p-12">
                        <div class="flex flex-wrap items-center justify-between gap-4">
                            <p class="text-xs uppercase tracking-[0.35em] text-[#8b7462]">
                                Viora Product
                            </p>

                            @if($product->stock > 0)
                                <span class="px-4 py-2 bg-[#edf7ed] text-green-700 text-[11px] uppercase tracking-[0.18em]">
                                    In Stock
                                </span>
                            @else
                                <span class="px-4 py-2 bg-red-100 text-red-700 text-[11px] uppercase tracking-[0.18em]">
                                    Out Of Stock
                                </span>
                            @endif
                        </div>

                        <h1 class="mt-5 text-4xl sm:text-5xl xl:text-6xl font-semibold leading-[1.05] tracking-tight">
                            {{ $product->name }}
                        </h1>

                        @if($product->short_description)
                            <p class="mt-5 text-base sm:text-lg leading-8 text-[#2f251e]/70">
                                {{ $product->short_description }}
                            </p>
                        @endif

                        <div class="mt-8 bg-[#f6f1ea] border border-[#eadfd3] p-5 sm:p-6">
                            <div class="grid grid-cols-2 gap-5 items-end">
                                <div>
                                    <p class="text-[10px] uppercase tracking-[0.25em] text-[#8b7462] mb-2">
                                        Price
                                    </p>
                                    <p class="text-3xl sm:text-4xl font-semibold text-[#1b0d03]">
                                        {{ $product->price }}
                                    </p>
                                </div>

                                <div class="text-right">
                                    <p class="text-[10px] uppercase tracking-[0.25em] text-[#8b7462] mb-2">
                                        Stock
                                    </p>
                                    <p class="text-lg sm:text-xl font-semibold text-[#1b0d03]">
                                        {{ $product->stock }} pcs
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8">
                            <h3 class="text-sm uppercase tracking-[0.25em] text-[#8b7462] mb-4">
                                Product Description
                            </h3>

                            <p class="text-base leading-8 text-[#2f251e]/75">
                                {{ $product->description }}
                            </p>
                        </div>

                        <!-- FORM -->
                        <form action="{{ url('cart/add/'.$product->id) }}" method="post" class="mt-9">
                            @csrf

                            <div class="mb-6">
                                <div class="flex items-center justify-between gap-4 mb-4">
                                    <label class="block text-sm uppercase tracking-[0.22em] text-[#8b7462]">
                                        Quantity
                                    </label>

                                    <p class="text-xs text-[#8b7462]">
                                        Available: {{ $product->stock }}
                                    </p>
                                </div>

                                <div class="flex flex-col sm:flex-row gap-4">
                                    <div class="inline-flex items-center border border-[#eadfd3] bg-white w-fit">
                                        <button 
                                            type="button"
                                            onclick="decreaseQty()"
                                            class="w-12 h-12 flex items-center justify-center text-xl hover:bg-[#fff2e5] transition"
                                        >
                                            −
                                        </button>

                                        <input 
                                            id="quantityInput"
                                            type="number" 
                                            name="quantity" 
                                            value="1" 
                                            min="1" 
                                            max="{{ $product->stock }}"
                                            class="w-16 h-12 text-center bg-white outline-none border-x border-[#eadfd3]"
                                        >

                                        <button 
                                            type="button"
                                            onclick="increaseQty()"
                                            class="w-12 h-12 flex items-center justify-center text-xl hover:bg-[#fff2e5] transition"
                                        >
                                            +
                                        </button>
                                    </div>

                                    @if($product->stock > 0)
                                        <button class="flex-1 bg-[#1b0d03] text-white px-8 py-4 uppercase tracking-[0.18em] text-xs font-semibold hover:bg-black transition">
                                            Add To Cart
                                        </button>
                                    @else
                                        <button disabled class="flex-1 bg-gray-400 text-white px-8 py-4 uppercase tracking-[0.18em] text-xs font-semibold cursor-not-allowed">
                                            Out Of Stock
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </form>

                        <!-- MINI BENEFITS -->
                        <div class="mt-8 border-t border-[#eadfd3] pt-7 grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="bg-[#f6f1ea] border border-[#eadfd3] p-4">
                                <p class="text-[10px] uppercase tracking-[0.2em] text-[#8b7462]">Quality</p>
                                <h4 class="mt-2 font-semibold text-[#1b0d03]">Premium Finish</h4>
                                <p class="mt-2 text-sm text-[#2f251e]/65">Made for everyday comfort with a refined feel.</p>
                            </div>

                            <div class="bg-[#f6f1ea] border border-[#eadfd3] p-4">
                                <p class="text-[10px] uppercase tracking-[0.2em] text-[#8b7462]">Returns</p>
                                <h4 class="mt-2 font-semibold text-[#1b0d03]">Easy Return</h4>
                                <p class="mt-2 text-sm text-[#2f251e]/65">Simple support for eligible return requests.</p>
                            </div>

                            <div class="bg-[#f6f1ea] border border-[#eadfd3] p-4">
                                <p class="text-[10px] uppercase tracking-[0.2em] text-[#8b7462]">Shipping</p>
                                <h4 class="mt-2 font-semibold text-[#1b0d03]">Fast Delivery</h4>
                                <p class="mt-2 text-sm text-[#2f251e]/65">Quick dispatch and smooth doorstep delivery.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- REPLACED STYLE NOTE SECTION -->
        <section class="px-4 sm:px-6 lg:px-14 pb-16 lg:pb-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                
                <div class="bg-[#1b0d03] text-white p-8 sm:p-10 lg:p-12">
                    <p class="text-xs uppercase tracking-[0.35em] text-[#e8c7ad] mb-4">
                        Why You’ll Love It
                    </p>

                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-semibold leading-tight">
                        Crafted to look elevated, feel effortless, and wear beautifully every day.
                    </h2>

                    <div class="mt-8 space-y-5">
                        <div class="flex items-start gap-4">
                            <span class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center shrink-0">01</span>
                            <div>
                                <h4 class="font-semibold">Premium Styling</h4>
                                <p class="mt-1 text-sm text-white/70 leading-6">
                                    A clean silhouette and polished finish that instantly feels more refined.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <span class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center shrink-0">02</span>
                            <div>
                                <h4 class="font-semibold">Easy To Pair</h4>
                                <p class="mt-1 text-sm text-white/70 leading-6">
                                    Designed to work beautifully with casual, smart, and everyday wardrobes.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <span class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center shrink-0">03</span>
                            <div>
                                <h4 class="font-semibold">Comfort First</h4>
                                <p class="mt-1 text-sm text-white/70 leading-6">
                                    Created for comfortable wear without losing that premium visual appeal.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-[#fbf8f4] border border-[#eadfd3] p-8 sm:p-10 lg:p-12">
                    <p class="text-xs uppercase tracking-[0.35em] text-[#8b7462] mb-4">
                        Delivery & Care
                    </p>

                    <h2 class="text-3xl sm:text-4xl font-semibold leading-tight text-[#1b0d03]">
                        Everything you need to know before you order.
                    </h2>

                    <div class="mt-8 space-y-6">
                        <div class="border-b border-[#eadfd3] pb-5">
                            <h4 class="font-semibold text-[#1b0d03]">Shipping Information</h4>
                            <p class="mt-2 text-sm leading-7 text-[#2f251e]/70">
                                Orders are processed quickly and delivered with care. Delivery timelines may vary depending on your location.
                            </p>
                        </div>

                        <div class="border-b border-[#eadfd3] pb-5">
                            <h4 class="font-semibold text-[#1b0d03]">Return Support</h4>
                            <p class="mt-2 text-sm leading-7 text-[#2f251e]/70">
                                Eligible products can be returned easily through our support process, giving you a worry-free shopping experience.
                            </p>
                        </div>

                        <div class="pb-1">
                            <h4 class="font-semibold text-[#1b0d03]">Care Advice</h4>
                            <p class="mt-2 text-sm leading-7 text-[#2f251e]/70">
                                For best results, handle with care and follow the recommended wash or maintenance instructions for long-lasting quality.
                            </p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <a href="{{ url('collection') }}" class="inline-flex items-center justify-center bg-[#1b0d03] text-white px-8 py-4 uppercase tracking-[0.16em] text-xs font-semibold hover:bg-black transition">
                            Explore More
                        </a>
                    </div>
                </div>

            </div>
        </section>

        <!-- RELATED PRODUCTS -->
        <section class="bg-[#fbf8f4] px-4 sm:px-6 lg:px-14 py-16 lg:py-20 border-y border-[#eadfd3]">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10">
                <div>
                    <p class="text-xs uppercase tracking-[0.35em] text-[#8b7462] mb-3">
                        Curated For You
                    </p>
                    <h2 class="text-3xl sm:text-5xl font-semibold leading-tight">
                        Related Products
                    </h2>
                </div>

                <a href="{{ url('collection') }}" class="inline-flex items-center gap-3 text-sm font-medium border-b border-[#1b0d03] pb-1 w-fit hover:text-[#7a4d2a] transition">
                    View All
                    <span>→</span>
                </a>
            </div>

            @if(isset($relatedProducts) && $relatedProducts->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-x-4 sm:gap-x-6 lg:gap-x-8 gap-y-10">
                    @foreach($relatedProducts as $item)
                        <a href="{{ url('product/'.$item->id) }}" class="group block">
                            <div class="relative bg-[#eee6dc] overflow-hidden aspect-[4/5] border border-[#eadfd3]">
                                <img 
                                    src="{{ asset('uploads/products/'.$item->image) }}"
                                    class="w-full h-full object-cover object-center transition duration-700 group-hover:scale-[1.04]"
                                    alt="{{ $item->name }}"
                                >

                                <div class="absolute inset-0 bg-gradient-to-t from-[#1b0d03]/55 via-[#1b0d03]/10 to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>

                                <div class="absolute left-3 right-3 bottom-3 opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition duration-500">
                                    <div class="flex items-center justify-between gap-3 bg-white/90 backdrop-blur-md px-4 py-3">
                                        <div>
                                            <p class="text-[10px] uppercase tracking-[0.2em] text-[#8b7462]">
                                                Viora Edit
                                            </p>
                                            <p class="text-xs sm:text-sm font-medium text-[#1b0d03]">
                                                View Product
                                            </p>
                                        </div>

                                        <span class="w-9 h-9 rounded-full bg-[#1b0d03] text-white flex items-center justify-center shrink-0">
                                            →
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-4">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="min-w-0">
                                        <h3 class="text-sm sm:text-base font-medium text-[#1b0d03] leading-snug truncate">
                                            {{ $item->name }}
                                        </h3>

                                        <p class="mt-1 text-xs sm:text-sm text-[#8b7462] truncate">
                                            {{ $item->short_description ?? \Illuminate\Support\Str::limit($item->description, 35) }}
                                        </p>
                                    </div>

                                    <p class="text-sm sm:text-base font-semibold text-[#1b0d03] whitespace-nowrap">
                                        {{ $item->price }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="bg-[#f6f1ea] border border-[#eadfd3] p-10 text-center">
                    <p class="text-[#2f251e]/60">
                        No related products available right now.
                    </p>
                </div>
            @endif
        </section>
    </main>

    <!-- PRODUCT DETAIL CTA -->
    <section class="relative bg-[#1b0d03] text-white px-4 sm:px-6 lg:px-14 py-16 sm:py-20 lg:py-24 overflow-hidden">
        <div class="absolute inset-0 opacity-25">
            <img 
                src="https://images.unsplash.com/photo-1529139574466-a303027c1d8b?auto=format&fit=crop&w=1600&q=80"
                class="w-full h-full object-cover object-center"
                alt="Viora Product CTA"
            >
        </div>

        <div class="absolute inset-0 bg-gradient-to-r from-[#1b0d03] via-[#1b0d03]/85 to-[#1b0d03]/35"></div>

        <div class="relative grid grid-cols-1 lg:grid-cols-[1.1fr_0.9fr] gap-10 lg:gap-16 items-center">
            
            <div>
                <p class="text-xs uppercase tracking-[0.35em] text-[#e8c7ad] mb-5">
                    Complete Your Look
                </p>

                <h2 class="text-4xl sm:text-5xl lg:text-6xl font-semibold leading-tight max-w-4xl">
                    Style This Piece With More Viora Essentials
                </h2>

                <p class="mt-6 text-sm sm:text-base leading-7 text-white/70 max-w-2xl">
                    Discover refined pieces that pair beautifully with this product. Build a wardrobe that feels modern, comfortable, and effortlessly premium.
                </p>

                <div class="mt-9 flex flex-col sm:flex-row gap-4">
                    <a href="{{ url('collection') }}"
                    class="inline-flex items-center justify-center bg-[#e8c7ad] text-[#1b0d03] px-8 py-4 uppercase tracking-[0.14em] text-xs font-semibold hover:bg-white transition">
                        Explore Collection
                    </a>

                    <a href="{{ url('cart') }}"
                    class="inline-flex items-center justify-center border border-white/30 text-white px-8 py-4 uppercase tracking-[0.14em] text-xs font-semibold hover:bg-white hover:text-[#1b0d03] transition">
                        View Cart
                    </a>
                </div>
            </div>

            <div class="bg-white/10 backdrop-blur-md border border-white/15 p-6 sm:p-8 lg:p-10">
                <p class="text-xs uppercase tracking-[0.3em] text-[#e8c7ad] mb-6">
                    Why Shop Viora
                </p>

                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <span class="w-11 h-11 rounded-full bg-[#e8c7ad] text-[#1b0d03] flex items-center justify-center shrink-0 font-semibold">
                            01
                        </span>
                        <div>
                            <h4 class="font-semibold text-lg">Premium Styling</h4>
                            <p class="mt-1 text-sm leading-6 text-white/65">
                                Clean silhouettes and refined details made for everyday fashion.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <span class="w-11 h-11 rounded-full bg-[#e8c7ad] text-[#1b0d03] flex items-center justify-center shrink-0 font-semibold">
                            02
                        </span>
                        <div>
                            <h4 class="font-semibold text-lg">Comfort Focused</h4>
                            <p class="mt-1 text-sm leading-6 text-white/65">
                                Designed to feel easy, wearable, and confident throughout the day.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <span class="w-11 h-11 rounded-full bg-[#e8c7ad] text-[#1b0d03] flex items-center justify-center shrink-0 font-semibold">
                            03
                        </span>
                        <div>
                            <h4 class="font-semibold text-lg">Easy Shopping</h4>
                            <p class="mt-1 text-sm leading-6 text-white/65">
                                Smooth browsing, simple cart experience, and support when you need it.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

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

        function decreaseQty() {
            const input = document.getElementById('quantityInput');
            let value = parseInt(input.value) || 1;

            if (value > 1) {
                input.value = value - 1;
            }
        }

        function increaseQty() {
            const input = document.getElementById('quantityInput');
            const max = parseInt(input.getAttribute('max')) || 1;
            let value = parseInt(input.value) || 1;

            if (value < max) {
                input.value = value + 1;
            }
        }
    </script>

</body>
</html>