<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viora | Collections</title>
    <link rel="icon" type="image/png" href="{{ asset('uploads/product/logo.png') }}?v=2">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#f6f1ea] text-[#160c05] overflow-x-hidden">

<!-- NAVBAR - COLLECTION -->
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
            <a href="{{ url('collection') }}" class="px-4 py-2 rounded-full bg-[#fff2e5] shadow-sm">Shop</a>
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
                <a href="{{ url('login') }}"
                   class="w-11 h-11 rounded-full bg-white/55 backdrop-blur-md border border-black/10 flex items-center justify-center hover:bg-[#1b0d03] hover:text-white transition"
                   title="Login">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0" />
                    </svg>
                </a>
            @endauth

            <a href="{{ url('cart') }}"
               class="w-11 h-11 rounded-full bg-white/55 backdrop-blur-md border border-black/10 flex items-center justify-center hover:bg-[#1b0d03] hover:text-white transition"
               title="Cart">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 7.5h10.5l-.75 12h-9l-.75-12zM9 7.5a3 3 0 016 0M9.75 11.25h.01M14.25 11.25h.01" />
                </svg>
            </a>
        </div>

        <!-- Mobile Icons -->
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
                <a href="{{ url('login') }}"
                   class="w-10 h-10 rounded-full bg-white/60 backdrop-blur-md border border-black/10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0" />
                    </svg>
                </a>
            @endauth

            <a href="{{ url('cart') }}"
               class="w-10 h-10 rounded-full bg-white/60 backdrop-blur-md border border-black/10 flex items-center justify-center">
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

<!-- Mobile Side Menu -->
<div id="mobileMenuOverlay" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/45" onclick="closeMobileMenu()"></div>

    <div id="mobileDrawer" class="absolute top-0 left-0 h-full w-[82%] max-w-sm bg-[#fbf8f4] shadow-2xl transform -translate-x-full transition duration-300">
        <div class="flex items-center justify-between px-7 py-6 border-b border-[#eadfd3]">
            <h2 class="text-2xl font-semibold tracking-[0.12em] uppercase">Menu</h2>
            <button onclick="closeMobileMenu()" class="w-10 h-10 flex items-center justify-center text-3xl">×</button>
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

<!-- PAGE HEADER -->
<section class="px-4 sm:px-6 lg:px-14 py-9 sm:py-10 lg:py-12 bg-[#fbf8f4] border-b border-[#eadfd3]">
    <div class="max-w-4xl">
        <p class="text-xs uppercase tracking-[0.35em] text-[#8b7462] mb-3">
            Viora Collection
        </p>

        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-semibold leading-tight">
            Shop
        </h1>

        <p class="mt-4 text-sm sm:text-base text-[#2f251e]/70 leading-7 max-w-2xl">
            Explore premium fashion pieces curated for modern men and women.
        </p>
    </div>
</section>

<!-- COLLECTION CONTENT -->
<section class="px-4 sm:px-6 lg:px-14 py-8 sm:py-10 lg:py-14 bg-[#f6f1ea]">

    <div class="grid grid-cols-1 lg:grid-cols-[270px_1fr] gap-8 lg:gap-10 items-start">

        <!-- FILTERS -->
        <aside class="bg-[#fbf8f4] border border-[#eadfd3] h-fit lg:sticky lg:top-8 self-start max-h-[calc(100vh-4rem)]">
            <form action="{{ url('collection') }}" method="get" class="px-6 py-7">

                <input type="hidden" name="search" value="{{ $search ?? '' }}">
                <input type="hidden" name="sort" value="{{ $sort ?? '' }}">

                <!-- CATEGORY -->
                <div class="border-b border-[#e4d7c8] pb-8">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-sm uppercase tracking-[0.22em] font-semibold text-[#1b0d03]">
                            Category
                        </h3>
                    </div>

                    <div class="space-y-4">

                        <!-- All Products -->
                        <a href="{{ url('collection') }}"
                        class="flex items-center gap-4 cursor-pointer group">
                            <span class="w-5 h-5 border-2 border-[#1b0d03] flex items-center justify-center rounded-sm bg-white">
                                @if(empty($category_id))
                                    <span class="w-2.5 h-2.5 bg-[#1b0d03] rounded-[2px]"></span>
                                @endif
                            </span>

                            <span class="text-sm text-[#1b0d03] group-hover:text-[#7a4d2a] transition">
                                All Products
                            </span>
                        </a>

                        @foreach($categories as $cat)
                            <label class="flex items-center gap-4 cursor-pointer group select-none">
                                <input 
                                    type="checkbox" 
                                    name="category_id[]" 
                                    value="{{ $cat->id }}"
                                    {{ in_array($cat->id, array_map('intval', $category_id ?? [])) ? 'checked' : '' }}
                                    class="w-5 h-5 cursor-pointer appearance-none border-2 border-[#1b0d03] bg-white checked:bg-[#1b0d03] checked:border-[#1b0d03] transition"
                                >

                                <span class="text-sm text-[#1b0d03] group-hover:text-[#7a4d2a] transition">
                                    {{ $cat->name }}
                                </span>
                            </label>
                        @endforeach

                    </div>
                </div>

                <!-- PRICE RANGE -->
                <div class="border-b border-[#e4d7c8] py-5">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm uppercase tracking-[0.22em] font-semibold text-[#1b0d03]">
                            Price Range
                        </h3>
                    </div>

                    <!-- Min -->
                    <div class="border border-[#e4d7c8] bg-[#fbf8f4] px-4 py-3 flex items-center justify-between">
                        <span class="text-sm text-[#6d7280]">
                            Min
                        </span>

                        <input 
                            id="minPriceInput"
                            type="number"
                            name="min_price"
                            value="{{ $min_price ?? '' }}"
                            placeholder="0"
                            min="0"
                            max="100000"
                            class="w-24 bg-transparent outline-none text-right font-semibold text-[#1b0d03]"
                        >
                    </div>

                    <div class="relative mt-4 mb-5">
                        <input 
                            id="minPriceRange"
                            type="range"
                            min="0"
                            max="100000"
                            step="100"
                            value="{{ $min_price ?? 0 }}"
                            class="w-full accent-[#1b0d03]"
                        >
                    </div>

                    <!-- Max -->
                    <div class="border border-[#e4d7c8] bg-[#fbf8f4] px-4 py-3 flex items-center justify-between">
                        <span class="text-sm text-[#6d7280]">
                            Max
                        </span>

                        <input 
                            id="maxPriceInput"
                            type="number"
                            name="max_price"
                            value="{{ $max_price ?? '' }}"
                            placeholder="100000"
                            min="0"
                            max="100000"
                            class="w-28 bg-transparent outline-none text-right font-semibold text-[#1b0d03]"
                        >
                    </div>

                    <div class="relative mt-5">
                        <input 
                            id="maxPriceRange"
                            type="range"
                            min="0"
                            max="100000"
                            step="100"
                            value="{{ $max_price ?? 100000 }}"
                            class="w-full accent-[#1b0d03]"
                        >
                    </div>
                </div>

                <!-- BUTTONS -->
                <div class="pt-7 space-y-3">
                    <button type="submit" class="w-full bg-[#1b0d03] text-white py-4 uppercase tracking-[0.18em] text-xs font-semibold hover:bg-black transition">
                        Apply Filter
                    </button>

                    <a href="{{ url('collection') }}"
                    class="block w-full text-center border border-[#e4d7c8] py-4 uppercase tracking-[0.18em] text-xs font-semibold text-[#1b0d03] hover:bg-white transition">
                        Clear Filter
                    </a>
                </div>
            </form>
        </aside>

        <!-- PRODUCTS -->
        <div>

            <!-- Search Bar aligned with product section -->
            <div class="mb-7">
                <form action="{{ url('collection') }}" method="get">
                    @foreach((array)($category_id ?? []) as $cid)
                        <input type="hidden" name="category_id[]" value="{{ $cid }}">
                    @endforeach

                    <input type="hidden" name="min_price" value="{{ $min_price ?? '' }}">
                    <input type="hidden" name="max_price" value="{{ $max_price ?? '' }}">
                    <input type="hidden" name="sort" value="{{ $sort ?? '' }}">

                    <div class="flex items-center bg-[#fbf8f4] border border-[#eadfd3] shadow-sm px-4 sm:px-5 py-3 sm:py-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#8b7462] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 100-15 7.5 7.5 0 000 15z" />
                        </svg>

                        <input 
                            type="text" 
                            name="search" 
                            value="{{ $search ?? '' }}"
                            placeholder="Search products..."
                            class="w-full bg-transparent outline-none px-3 sm:px-4 text-sm sm:text-base"
                        >

                        <button class="hidden sm:inline-block bg-[#1b0d03] text-white px-6 py-2 text-xs uppercase tracking-[0.16em] hover:bg-black transition">
                            Search
                        </button>
                    </div>
                </form>
            </div>

            <!-- Top Bar -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-7">

                <p class="text-sm text-[#2f251e]/70">
                    Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} products
                </p>

                <form action="{{ url('collection') }}" method="get">
                    <input type="hidden" name="search" value="{{ $search ?? '' }}">

                    @foreach((array)($category_id ?? []) as $cid)
                        <input type="hidden" name="category_id[]" value="{{ $cid }}">
                    @endforeach

                    <input type="hidden" name="min_price" value="{{ $min_price ?? '' }}">
                    <input type="hidden" name="max_price" value="{{ $max_price ?? '' }}">

                    <select 
                        name="sort" 
                        class="border border-[#eadfd3] bg-[#fbf8f4] px-4 py-3 text-sm outline-none min-w-[180px]" 
                        onchange="this.form.submit()"
                    >
                        <option value="" {{ empty($sort) ? 'selected' : '' }}>Featured</option>
                        <option value="latest" {{ ($sort ?? '') == 'latest' ? 'selected' : '' }}>Latest</option>
                        <option value="low_high" {{ ($sort ?? '') == 'low_high' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="high_low" {{ ($sort ?? '') == 'high_low' ? 'selected' : '' }}>Price: High to Low</option>
                    </select>
                </form>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-x-4 sm:gap-x-6 lg:gap-x-8 gap-y-10 sm:gap-y-12">

                @forelse($products as $product)
                    <a href="{{ url('product/'.$product->id) }}" class="group block">

                        <div class="relative bg-[#eee6dc] overflow-hidden aspect-[4/5]">
                            <img 
                                src="{{ asset('uploads/products/'.$product->image) }}"
                                class="w-full h-full object-cover object-center transition duration-700 group-hover:scale-[1.035]"
                                alt="{{ $product->name }}"
                            >

                            <div class="absolute inset-0 bg-gradient-to-t from-[#1b0d03]/55 via-[#1b0d03]/10 to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>

                            <div class="absolute left-3 right-3 sm:left-4 sm:right-4 bottom-3 sm:bottom-4 opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition duration-500">
                                <div class="flex items-center justify-between gap-3 bg-white/90 backdrop-blur-md px-4 py-3">
                                    <div>
                                        <p class="text-[10px] uppercase tracking-[0.2em] text-[#8b7462]">
                                            Viora Select
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
                                        {{ $product->name }}
                                    </h3>

                                    <p class="mt-1 text-xs sm:text-sm text-[#8b7462] truncate">
                                        {{ Str::limit($product->short_description, 45)}}
                                    </p>
                                </div>

                                <p class="text-sm sm:text-base font-semibold text-[#1b0d03] whitespace-nowrap">
                                    {{ $product->price }}
                                </p>
                            </div>
                        </div>

                    </a>
                @empty
                    <div class="col-span-full bg-[#fbf8f4] p-12 text-center border border-[#eadfd3]">
                        <p class="text-[#2f251e]/60 text-lg">No products found</p>
                    </div>
                @endforelse

            </div>

            <!-- Pagination -->
            @if($products->hasPages())
                <div class="mt-14 flex justify-center">
                    <div class="flex flex-wrap items-center justify-center gap-2">

                        @if ($products->onFirstPage())
                            <span class="px-4 py-2 border border-[#eadfd3] text-[#8b7462]/50 bg-[#fbf8f4]">
                                Previous
                            </span>
                        @else
                            <a href="{{ $products->previousPageUrl() }}" class="px-4 py-2 border border-[#eadfd3] bg-[#fbf8f4] hover:bg-[#1b0d03] hover:text-white transition">
                                Previous
                            </a>
                        @endif

                        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                            @if ($page == $products->currentPage())
                                <span class="w-10 h-10 flex items-center justify-center bg-[#1b0d03] text-white">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" class="w-10 h-10 flex items-center justify-center border border-[#eadfd3] bg-[#fbf8f4] hover:bg-[#1b0d03] hover:text-white transition">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach

                        @if ($products->hasMorePages())
                            <a href="{{ $products->nextPageUrl() }}" class="px-4 py-2 border border-[#eadfd3] bg-[#fbf8f4] hover:bg-[#1b0d03] hover:text-white transition">
                                Next
                            </a>
                        @else
                            <span class="px-4 py-2 border border-[#eadfd3] text-[#8b7462]/50 bg-[#fbf8f4]">
                                Next
                            </span>
                        @endif

                    </div>
                </div>
            @endif

        </div>

    </div>

</section>

<!-- FOOTER -->
<footer class="bg-[#14100e] text-white">

    <div class="px-4 sm:px-6 lg:px-14 py-12 sm:py-14">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">

            <div>
                <h4 class="text-3xl font-semibold">VIORA</h4>
                <p class="mt-4 text-sm text-white/60 leading-6">
                    Modern fashion for men and women — minimal, premium, and easy to wear.
                </p>
            </div>

            <div>
                <h5 class="font-semibold uppercase tracking-[0.15em] text-sm">Shop</h5>
                <div class="mt-5 space-y-3 text-sm text-white/60">
                    <a href="{{ url('collection') }}" class="block hover:text-white">All Collection</a>
                    <a href="{{ url('categories') }}" class="block hover:text-white">Categories</a>
                    <a href="{{ url('cart') }}" class="block hover:text-white">Cart</a>
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
                </div>
            </div>

        </div>

        <div class="border-t border-white/10 mt-10 sm:mt-12 pt-6 flex flex-col sm:flex-row justify-between gap-4 text-xs text-white/40">
            <p>© 2026 Viora. All rights reserved.</p>
            <div class="flex flex-wrap gap-5">
                <a href="#" class="hover:text-white">Privacy Policy</a>
                <a href="#" class="hover:text-white">Terms</a>
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

    const minPriceInput = document.getElementById('minPriceInput');
    const maxPriceInput = document.getElementById('maxPriceInput');
    const minPriceRange = document.getElementById('minPriceRange');
    const maxPriceRange = document.getElementById('maxPriceRange');

    function syncPriceValues() {
        let minValue = parseInt(minPriceInput.value || 0);
        let maxValue = parseInt(maxPriceInput.value || 100000);

        if (minValue < 0) minValue = 0;
        if (maxValue > 100000) maxValue = 100000;

        if (minValue > maxValue) {
            minValue = maxValue;
        }

        minPriceInput.value = minValue;
        maxPriceInput.value = maxValue;
        minPriceRange.value = minValue;
        maxPriceRange.value = maxValue;
    }

    if (minPriceInput && maxPriceInput && minPriceRange && maxPriceRange) {
        minPriceRange.addEventListener('input', function () {
            minPriceInput.value = this.value;
            syncPriceValues();
        });

        maxPriceRange.addEventListener('input', function () {
            maxPriceInput.value = this.value;
            syncPriceValues();
        });

        minPriceInput.addEventListener('input', syncPriceValues);
        maxPriceInput.addEventListener('input', syncPriceValues);
    }
</script>

</body>
</html>