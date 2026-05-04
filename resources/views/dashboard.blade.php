<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viora | Fashion Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#f6f1ea] text-[#160c05] overflow-x-hidden">

<!-- HERO SECTION -->
<section class="relative min-h-screen overflow-hidden">

    <!-- Background Decor -->
    <div class="absolute inset-0 bg-[#f6f1ea]"></div>
    <div class="absolute -top-32 -left-32 w-72 sm:w-96 h-72 sm:h-96 bg-[#ead2ba]/50 rounded-full blur-3xl"></div>
    <div class="absolute top-32 right-0 w-64 sm:w-80 h-64 sm:h-80 bg-[#fff1df]/70 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-1/2 w-[28rem] sm:w-[36rem] h-[16rem] sm:h-[20rem] bg-white/60 rounded-full blur-3xl"></div>

    <!-- Navbar -->
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
                <a href="{{ url('/') }}" class="px-4 py-2 rounded-full bg-[#fff2e5] shadow-sm">Home</a>
                <a href="{{ url('collection') }}" class="hover:text-[#7a4d2a] transition">Collection</a>
                <a href="{{ url('about') }}" class="hover:text-[#7a4d2a] transition">About Us</a>
                <a href="{{ url('contact') }}" class="hover:text-[#7a4d2a] transition">Contact Us</a>
            </div>

            <!-- Desktop Icons -->
            <div class="hidden lg:flex items-center gap-4 relative">

                <!-- Profile Icon -->
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

                    <!-- Profile Dropdown -->
                    <div 
                        id="profileMenu" 
                        class="hidden absolute right-14 top-14 w-56 bg-white border border-[#eadfd3] shadow-xl shadow-black/10 rounded-2xl overflow-hidden"
                    >
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

                <!-- Cart Icon -->
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

            <!-- Mobile Icons + Menu -->
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
            <a href="{{ url('/') }}" class="block text-xl font-semibold tracking-[0.18em] uppercase text-[#7a4d2a]">Home</a>
            <a href="{{ url('collection') }}" class="block text-xl font-semibold tracking-[0.18em] uppercase">Shop</a>
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

    <!-- Hero Content -->
    <div class="relative z-20 px-4 sm:px-6 lg:px-14 pt-8 sm:pt-12 lg:pt-14 text-center">

        <p class="text-[10px] sm:text-xs uppercase tracking-[0.28em] sm:tracking-[0.35em] text-[#6b5a4d] mb-4 sm:mb-5">
            New Arrivals, 2026
        </p>

        <h1 class="max-w-6xl mx-auto text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl font-semibold leading-[1.06] tracking-tight">
            Your Source for Trendsetting Fashion
        </h1>

        <p class="max-w-3xl mx-auto mt-5 sm:mt-6 text-sm sm:text-base md:text-lg leading-7 md:leading-8 text-[#2f251e]/80">
            Explore modern men’s and women’s fashion designed for everyday comfort, bold statements, and timeless style.
        </p>

        <div class="mt-7 sm:mt-8 flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4">
            <a href="{{ url('collection') }}"
               class="group inline-flex items-center justify-center gap-4 bg-[#1b0d03] text-white px-7 sm:px-8 py-4 rounded-full font-medium shadow-lg shadow-black/10 hover:bg-black transition w-full sm:w-auto">
                New Collection

                <span class="w-8 h-8 rounded-full bg-white text-[#1b0d03] flex items-center justify-center transition translate-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                    </svg>
                </span>
            </a>

            <a href="{{ url('') }}"
               class="inline-flex items-center justify-center px-7 sm:px-8 py-4 rounded-full border border-[#1b0d03]/10 bg-white/40 backdrop-blur-sm hover:bg-white transition w-full sm:w-auto">
                Browse Categories
            </a>
        </div>
    </div>

    <!-- Fashion Arches -->
    <div class="relative z-20 px-4 sm:px-6 lg:px-14 mt-10 sm:mt-14 lg:mt-16 pb-12 sm:pb-14">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4 lg:gap-6 items-end">

            <div class="h-44 xs:h-52 sm:h-64 md:h-72 lg:h-80 rounded-t-full overflow-hidden bg-[#a7d4cf] shadow-sm">
                <img src="https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?auto=format&fit=crop&w=700&q=80" class="w-full h-full object-cover object-center" alt="Women Fashion">
            </div>

            <div class="h-52 sm:h-72 md:h-80 lg:h-96 rounded-t-full overflow-hidden bg-[#d98b98] shadow-sm">
                <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=700&q=80" class="w-full h-full object-cover object-center" alt="Men Fashion">
            </div>

            <div class="h-44 xs:h-52 sm:h-64 md:h-72 lg:h-80 rounded-t-full overflow-hidden bg-[#16473e] shadow-sm">
                <img src="https://images.unsplash.com/photo-1529139574466-a303027c1d8b?auto=format&fit=crop&w=700&q=80" class="w-full h-full object-cover object-center" alt="Women Collection">
            </div>

            <div class="h-52 sm:h-72 md:h-80 lg:h-96 rounded-t-full overflow-hidden bg-[#e7ad32] shadow-sm">
                <img src="https://images.unsplash.com/photo-1492447166138-50c3889fccb1?auto=format&fit=crop&w=700&q=80" class="w-full h-full object-cover object-center" alt="Men Style">
            </div>

            <div class="h-44 xs:h-52 sm:h-64 md:h-72 lg:h-80 rounded-t-full overflow-hidden bg-[#cf7e75] shadow-sm">
                <img src="https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?auto=format&fit=crop&w=700&q=80" class="w-full h-full object-cover object-center" alt="Ladies Wear">
            </div>

            <div class="h-52 sm:h-72 md:h-80 lg:h-96 rounded-t-full overflow-hidden bg-[#f0d2b0] shadow-sm">
                <img src="https://images.unsplash.com/photo-1516826957135-700dedea698c?auto=format&fit=crop&w=700&q=80" class="w-full h-full object-cover object-center" alt="Mens Wear">
            </div>

        </div>
    </div>

</section>

<!-- COLLECTION SECTION -->
<section class="bg-[#fbf8f4] px-4 sm:px-6 lg:px-14 py-14 sm:py-16 lg:py-24">

    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10 sm:mb-12">
        <div>
            <p class="text-xs uppercase tracking-[0.35em] text-[#8b7462] mb-3">
                Fresh Collection
            </p>
            <h2 class="text-3xl sm:text-5xl lg:text-6xl font-semibold leading-tight">
                New Arrivals
            </h2>
            <p class="mt-4 max-w-xl text-sm sm:text-base text-[#2f251e]/70 leading-7">
                Explore the latest styles added to Viora — handpicked fashion pieces for modern men and women.
            </p>
        </div>

        <a href="{{ url('collection') }}"
           class="inline-flex items-center gap-3 text-s font-medium border-b border-[#1b0d03] pb-1 w-fit hover:text-[#7a4d2a] transition">
            View All
            <span>→</span>
        </a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-x-4 sm:gap-x-6 lg:gap-x-8 gap-y-10 sm:gap-y-12">

        @forelse($products as $product)
            <a href="{{ url('product/'.$product->id) }}" class="group block">

                <!-- Image -->
                <div class="relative bg-[#eee6dc] overflow-hidden aspect-[4/5]">
                    <img 
                        src="{{ asset('uploads/products/'.$product->image) }}"
                        class="w-full h-full object-cover object-center transition duration-700 group-hover:scale-[1.035]"
                        alt="{{ $product->name }}"
                    >

                    <!-- Premium Top Label -->
                    <div class="absolute top-3 left-3 sm:top-4 sm:left-4">
                        <span class="bg-white/90 backdrop-blur px-3 py-1.5 text-[10px] sm:text-[11px] uppercase tracking-[0.18em] text-[#1b0d03]">
                            New
                        </span>
                    </div>

                    <!-- Premium Hover Overlay Updated -->
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Info -->
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
            <div class="col-span-full bg-white p-10 sm:p-12 text-center border border-[#eadfd3]">
                <p class="text-[#2f251e]/60">No products available right now.</p>
            </div>
        @endforelse

    </div>

</section>

<!-- STORY SECTION -->
<section class="bg-[#f6f1ea] py-14 sm:py-16 lg:py-24">

    <div class="grid grid-cols-1 lg:grid-cols-2 min-h-auto lg:min-h-[680px]">

        <div class="relative h-[360px] sm:h-[520px] lg:h-auto overflow-hidden">
            <img 
                src="https://images.unsplash.com/photo-1529139574466-a303027c1d8b?auto=format&fit=crop&w=1400&q=80"
                class="absolute inset-0 w-full h-full object-cover object-center"
                alt="Viora Journal"
            >
        </div>

        <div class="flex items-center px-4 sm:px-8 lg:px-20 py-12 sm:py-14 lg:py-20 bg-[#fffaf4]">
            <div class="max-w-2xl">
                <p class="text-xs uppercase tracking-[0.35em] text-[#8b7462] mb-5">
                    Viora Editorial
                </p>

                <h2 class="text-3xl sm:text-5xl lg:text-6xl font-semibold leading-tight">
                    Crafted Looks For Real Everyday Style
                </h2>

                <p class="mt-6 sm:mt-7 text-sm sm:text-lg leading-7 sm:leading-8 text-[#2f251e]/75">
                    Viora is built for people who want style that feels effortless. From relaxed daily essentials to polished occasion wear, every product is selected to balance comfort, fit, and a modern fashion mood.
                </p>

                <p class="mt-4 sm:mt-5 text-sm sm:text-lg leading-7 sm:leading-8 text-[#2f251e]/75">
                    Our collection brings together men’s and women’s fashion with clean silhouettes, refined colors, and wearable pieces that can move from casual days to evening plans.
                </p>

                <a href="{{ url('collection') }}"
                   class="mt-8 sm:mt-9 inline-flex items-center gap-4 bg-[#1b0d03] text-white px-7 sm:px-8 py-4 font-medium hover:bg-black transition">
                    Explore Products
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                    </svg>
                </a>
            </div>
        </div>

    </div>

</section>

<!-- CATEGORY SECTION -->
<section class="bg-[#fbf8f4] px-4 sm:px-6 lg:px-14 py-14 sm:py-16 lg:py-24">

    <div class="mb-10 sm:mb-12">
        <p class="text-xs uppercase tracking-[0.35em] text-[#8b7462] mb-4">
            Shop By Category
        </p>
        <h2 class="text-3xl sm:text-5xl lg:text-6xl font-semibold leading-tight">
            Find Your Style
        </h2>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-7">

        @forelse($categories as $cat)
            <a href="{{ url('category/'.$cat->id) }}" class="group relative h-72 sm:h-96 overflow-hidden bg-[#1b0d03] shadow-sm">

                <img 
                    src="https://cdn.shopify.com/s/files/1/0598/1070/9672/files/vjv-now-1_480x480.jpg?v=1718277598"
                    class="absolute inset-0 w-full h-full object-cover opacity-75 group-hover:scale-105 transition duration-700"
                    alt="{{ $cat->name }}"
                >

                <div class="absolute inset-0 bg-gradient-to-t from-black/65 via-black/25 to-black/10 group-hover:from-black/75 transition"></div>

                <div class="absolute inset-x-0 bottom-0 p-6 sm:p-7 text-white">
                    <p class="text-xs uppercase tracking-[0.28em] text-white/75 mb-3">
                        Shop Category
                    </p>

                    <h3 class="text-3xl sm:text-4xl font-semibold">
                        {{ $cat->name }}
                    </h3>

                    <p class="mt-4 text-sm text-white/75">
                        Explore Collection
                    </p>
                </div>
            </a>
        @empty
            <div class="col-span-full bg-white rounded-2xl p-10 text-center">
                <p class="text-gray-500">No categories available right now.</p>
            </div>
        @endforelse

    </div>

</section>

<!-- CTA SECTION -->
<section class="relative min-h-[420px] bg-[#201612] text-white overflow-hidden">

    <img 
        src="https://images.unsplash.com/photo-1496747611176-843222e1e57c?auto=format&fit=crop&w=1600&q=80"
        class="absolute inset-0 w-full h-full object-cover opacity-25"
        alt="Wardrobe"
    >

    <div class="absolute inset-0 bg-gradient-to-r from-[#1b0d03] via-[#1b0d03]/80 to-[#1b0d03]/50"></div>

    <div class="relative z-10 min-h-[420px] flex items-center px-4 sm:px-6 lg:px-14 py-16">
        <div class="max-w-3xl">
            <p class="text-xs uppercase tracking-[0.35em] text-[#e6cbb5] mb-5">
                Modern Wardrobe
            </p>

            <h2 class="text-3xl sm:text-5xl lg:text-7xl font-semibold leading-tight">
                Elevate Your Wardrobe With Viora
            </h2>

            <p class="mt-6 text-sm sm:text-base text-white/75 leading-7 max-w-2xl">
                Discover premium fashion pieces made for everyday confidence — clean, comfortable, and styled for both men and women.
            </p>

            <a href="{{ url('collection') }}"
               class="mt-8 sm:mt-9 inline-flex items-center gap-4 bg-[#e8c7ad] text-[#1b0d03] px-7 sm:px-8 py-4 font-semibold uppercase tracking-[0.12em] text-sm hover:bg-white transition">
                Start Shopping
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                </svg>
            </a>
        </div>
    </div>

</section>

<!-- JOIN + FOOTER -->
<footer class="bg-[#14100e] text-white">

    <div class="px-4 sm:px-6 lg:px-14 py-14 sm:py-16 lg:py-20 border-b border-white/10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

            <div>
                <p class="text-xs uppercase tracking-[0.35em] text-[#e6cbb5] mb-4">
                    Newsletter
                </p>
                <h3 class="text-3xl sm:text-5xl font-semibold">
                    Join Our World
                </h3>
                <p class="mt-4 text-sm text-white/60 max-w-xl leading-7">
                    Subscribe for new arrivals, style inspiration, and special Viora updates.
                </p>
            </div>

            <form class="flex flex-col sm:flex-row gap-3 w-full">
                <input 
                    type="email" 
                    placeholder="Enter your email"
                    class="flex-1 bg-white/10 border border-white/10 px-5 py-4 outline-none text-white placeholder:text-white/40"
                >
                <button class="bg-[#e8c7ad] text-[#1b0d03] px-8 py-4 uppercase tracking-[0.12em] text-sm font-semibold hover:bg-white transition">
                    Subscribe
                </button>
            </form>

        </div>
    </div>

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
                    <a href="{{ url('about') }}" class="block hover:text-white">About Us</a>
                    <a href="{{ url('cotact') }}" class="block hover:text-white">Contact Us</a>
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
                    <a href="#" class="block hover:text-white">Sustainability</a>
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

    function toggleMobileProfile() {
        openMobileMenu();
    }

    document.addEventListener('click', function(event) {
        const profileMenu = document.getElementById('profileMenu');

        if (profileMenu && !event.target.closest('#profileMenu') && !event.target.closest('button[onclick="toggleProfileMenu()"]')) {
            profileMenu.classList.add('hidden');
        }
    });
</script>

</body>
</html>