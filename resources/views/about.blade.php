<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viora | About Us</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#f6f1ea] text-[#160c05] overflow-x-hidden">

<!-- NAVBAR - ABOUT -->
<nav class="relative z-40 w-full px-4 sm:px-6 lg:px-14 py-5">
    <div class="flex items-center justify-between">

        <a href="{{ url('/') }}" class="inline-flex items-center">
            <h2 class="text-[#1b0d03] text-xl sm:text-2xl tracking-[0.35em] uppercase font-medium">
                Viora
            </h2>
        </a>

        <div class="hidden lg:flex items-center gap-8 text-sm font-medium bg-white/45 backdrop-blur-md border border-white/60 px-5 py-3 rounded-full">
            <a href="{{ url('/') }}" class="hover:text-[#7a4d2a] transition">Home</a>
            <a href="{{ url('collection') }}" class="hover:text-[#7a4d2a] transition">Shop</a>
            <a href="{{ url('about') }}" class="px-4 py-2 rounded-full bg-[#fff2e5] shadow-sm">About Us</a>
            <a href="{{ url('contact') }}" class="hover:text-[#7a4d2a] transition">Contact Us</a>
        </div>

        <div class="hidden lg:flex items-center gap-4 relative">
            @auth
                <button type="button" onclick="toggleProfileMenu()" class="w-11 h-11 rounded-full bg-white/55 backdrop-blur-md border border-black/10 flex items-center justify-center hover:bg-[#1b0d03] hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0" />
                    </svg>
                </button>

                <div id="profileMenu" class="hidden absolute right-14 top-14 w-56 bg-white border border-[#eadfd3] shadow-xl shadow-black/10 rounded-2xl overflow-hidden">
                    <div class="px-5 py-4 border-b border-[#eadfd3]">
                        <p class="text-xs uppercase tracking-[0.2em] text-[#8b7462] mb-1">Signed in as</p>
                        <p class="font-semibold text-[#1b0d03] truncate">{{ Auth::user()->name }}</p>
                    </div>

                    <a href="{{ url('my-orders') }}" class="block px-5 py-3 text-sm hover:bg-[#fff2e5] transition">My Orders</a>

                    <form action="{{ url('logout') }}" method="post">
                        @csrf
                        <button class="w-full text-left px-5 py-3 text-sm text-red-600 hover:bg-red-50 transition">Logout</button>
                    </form>
                </div>
            @else
                <a href="{{ url('login') }}" class="w-11 h-11 rounded-full bg-white/55 backdrop-blur-md border border-black/10 flex items-center justify-center hover:bg-[#1b0d03] hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0" />
                    </svg>
                </a>
            @endauth

            <a href="{{ url('cart') }}" class="w-11 h-11 rounded-full bg-white/55 backdrop-blur-md border border-black/10 flex items-center justify-center hover:bg-[#1b0d03] hover:text-white transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 7.5h10.5l-.75 12h-9l-.75-12zM9 7.5a3 3 0 016 0M9.75 11.25h.01M14.25 11.25h.01" />
                </svg>
            </a>
        </div>

        <div class="lg:hidden flex items-center gap-3">
            @auth
                <button type="button" onclick="openMobileMenu()" class="w-10 h-10 rounded-full bg-white/60 backdrop-blur-md border border-black/10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0" />
                    </svg>
                </button>
            @else
                <a href="{{ url('login') }}" class="w-10 h-10 rounded-full bg-white/60 backdrop-blur-md border border-black/10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0" />
                    </svg>
                </a>
            @endauth

            <a href="{{ url('cart') }}" class="w-10 h-10 rounded-full bg-white/60 backdrop-blur-md border border-black/10 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 7.5h10.5l-.75 12h-9l-.75-12zM9 7.5a3 3 0 016 0M9.75 11.25h.01M14.25 11.25h.01" />
                </svg>
            </a>

            <button type="button" onclick="openMobileMenu()" class="w-10 h-10 rounded-full bg-white/60 backdrop-blur-md border border-black/10 flex items-center justify-center">
                <span class="text-2xl leading-none">☰</span>
            </button>
        </div>
    </div>
</nav>

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
            <a href="{{ url('about') }}" class="block text-xl font-semibold tracking-[0.18em] uppercase text-[#7a4d2a]">About</a>
            <a href="{{ url('contact') }}" class="block text-xl font-semibold tracking-[0.18em] uppercase">Contact</a>
        </div>

        <div class="px-5 py-6">
            @auth
                <div>
                    <p class="text-xs uppercase tracking-[0.2em] text-[#8b7462]">Signed in as</p>
                    <p class="mt-2 text-lg font-semibold text-[#1b0d03]">{{ Auth::user()->name }}</p>
                    <a href="{{ url('my-orders') }}" class="block mt-4 text-sm text-[#8b7462]">My Orders</a>
                    <form action="{{ url('logout') }}" method="post" class="mt-3">
                        @csrf
                        <button class="text-sm text-red-600">Logout</button>
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

<!-- HERO -->
<section class="relative bg-[#fbf8f4] overflow-hidden">
    <div class="absolute -top-32 -right-20 w-96 h-96 bg-[#ead2ba]/60 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-white/70 rounded-full blur-3xl"></div>

    <div class="relative px-4 sm:px-6 lg:px-14 py-16 sm:py-20 lg:py-28">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">

            <div>
                <p class="text-xs uppercase tracking-[0.35em] text-[#8b7462] mb-5">
                    About Viora
                </p>

                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-semibold leading-tight tracking-tight">
                    Fashion Made For Modern Everyday Living
                </h1>

                <p class="mt-6 text-base sm:text-lg leading-8 text-[#2f251e]/75 max-w-2xl">
                    Viora is a fashion destination created for people who love clean design, comfortable fits, and timeless pieces. We bring together men’s and women’s fashion that feels premium without losing everyday practicality.
                </p>

                <div class="mt-9 flex flex-col sm:flex-row gap-4">
                    <a href="{{ url('collection') }}"
                       class="inline-flex items-center justify-center bg-[#1b0d03] text-white px-8 py-4 uppercase tracking-[0.14em] text-xs font-semibold hover:bg-black transition">
                        Explore Collection
                    </a>

                    <a href="{{ url('contact') }}"
                       class="inline-flex items-center justify-center border border-[#1b0d03]/20 px-8 py-4 uppercase tracking-[0.14em] text-xs font-semibold hover:bg-white transition">
                        Contact Us
                    </a>
                </div>
            </div>

            <div class="relative">
                <div class="h-[420px] sm:h-[560px] lg:h-[640px] overflow-hidden bg-[#e6d7c6]">
                    <img 
                        src="https://images.unsplash.com/photo-1496747611176-843222e1e57c?auto=format&fit=crop&w=1400&q=80"
                        class="w-full h-full object-cover object-center"
                        alt="About Viora Fashion"
                    >
                </div>

                <div class="absolute -bottom-8 left-6 right-6 sm:left-auto sm:right-8 sm:w-72 bg-[#1b0d03] text-white p-6 shadow-2xl">
                    <p class="text-xs uppercase tracking-[0.25em] text-white/60 mb-3">
                        Since 2026
                    </p>
                    <h3 class="text-2xl font-semibold">
                        Modern essentials with premium detailing.
                    </h3>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- STORY -->
<section class="bg-[#f6f1ea] px-4 sm:px-6 lg:px-14 py-16 sm:py-20 lg:py-24">
    <div class="max-w-6xl mx-auto text-center">
        <p class="text-xs uppercase tracking-[0.35em] text-[#8b7462] mb-5">
            Our Story
        </p>

        <h2 class="text-4xl sm:text-5xl lg:text-6xl font-semibold leading-tight">
            Designed To Feel Effortless, Styled To Look Refined
        </h2>

        <p class="mt-7 text-base sm:text-lg leading-8 text-[#2f251e]/75 max-w-4xl mx-auto">
            Our goal is simple — to make fashion feel easy, confident, and wearable. Every collection at Viora is selected with attention to fabric, silhouette, color, and styling so customers can build wardrobes that work for daily life, special moments, and everything in between.
        </p>
    </div>
</section>

<!-- VALUES -->
<section class="bg-[#fbf8f4] px-4 sm:px-6 lg:px-14 py-16 sm:py-20 lg:py-24">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">

        <div class="bg-white border border-[#eadfd3] p-8 sm:p-10">
            <span class="text-sm uppercase tracking-[0.25em] text-[#8b7462]">01</span>
            <h3 class="mt-6 text-2xl font-semibold">Quality First</h3>
            <p class="mt-4 text-sm leading-7 text-[#2f251e]/70">
                We focus on fashion pieces that feel comfortable, last longer, and maintain a premium look in everyday use.
            </p>
        </div>

        <div class="bg-white border border-[#eadfd3] p-8 sm:p-10">
            <span class="text-sm uppercase tracking-[0.25em] text-[#8b7462]">02</span>
            <h3 class="mt-6 text-2xl font-semibold">Modern Styling</h3>
            <p class="mt-4 text-sm leading-7 text-[#2f251e]/70">
                Our collections are selected for clean silhouettes, balanced colors, and trend-aware designs.
            </p>
        </div>

        <div class="bg-white border border-[#eadfd3] p-8 sm:p-10">
            <span class="text-sm uppercase tracking-[0.25em] text-[#8b7462]">03</span>
            <h3 class="mt-6 text-2xl font-semibold">Everyday Comfort</h3>
            <p class="mt-4 text-sm leading-7 text-[#2f251e]/70">
                Viora blends style and comfort so every outfit feels natural from morning plans to evening moments.
            </p>
        </div>

    </div>
</section>

<!-- IMAGE + CONTENT -->
<section class="bg-[#f6f1ea]">
    <div class="grid grid-cols-1 lg:grid-cols-2">

        <div class="h-[420px] sm:h-[560px] lg:h-auto overflow-hidden">
            <img 
                src="https://images.unsplash.com/photo-1529139574466-a303027c1d8b?auto=format&fit=crop&w=1400&q=80"
                class="w-full h-full object-cover object-center"
                alt="Fashion Editorial"
            >
        </div>

        <div class="px-4 sm:px-10 lg:px-20 py-14 sm:py-20 lg:py-28 bg-[#fffaf4] flex items-center">
            <div class="max-w-2xl">
                <p class="text-xs uppercase tracking-[0.35em] text-[#8b7462] mb-5">
                    What We Believe
                </p>

                <h2 class="text-4xl sm:text-5xl lg:text-6xl font-semibold leading-tight">
                    Style Should Be Simple, Personal And Confident
                </h2>

                <p class="mt-6 text-base sm:text-lg leading-8 text-[#2f251e]/75">
                    We believe fashion should not feel complicated. Viora helps customers discover pieces that are easy to style, comfortable to wear, and polished enough to create a strong impression.
                </p>

                <div class="mt-8 grid grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-4xl font-semibold">500+</h4>
                        <p class="mt-2 text-sm text-[#8b7462]">Curated Styles</p>
                    </div>

                    <div>
                        <h4 class="text-4xl font-semibold">24/7</h4>
                        <p class="mt-2 text-sm text-[#8b7462]">Online Access</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- CTA -->
<section class="relative bg-[#1b0d03] text-white px-4 sm:px-6 lg:px-14 py-16 sm:py-20 lg:py-24 overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <img 
            src="https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?auto=format&fit=crop&w=1600&q=80"
            class="w-full h-full object-cover"
            alt="Viora CTA"
        >
    </div>

    <div class="relative max-w-4xl">
        <p class="text-xs uppercase tracking-[0.35em] text-[#e8c7ad] mb-5">
            Start Your Style Journey
        </p>

        <h2 class="text-4xl sm:text-5xl lg:text-6xl font-semibold leading-tight">
            Build A Wardrobe That Feels Like You
        </h2>

        <p class="mt-5 text-sm sm:text-base leading-7 text-white/70 max-w-2xl">
            Explore collections made for modern men and women who value comfort, confidence, and clean fashion.
        </p>

        <a href="{{ url('collection') }}"
           class="mt-8 inline-flex items-center bg-[#e8c7ad] text-[#1b0d03] px-8 py-4 uppercase tracking-[0.14em] text-xs font-semibold hover:bg-white transition">
            Shop Now
        </a>
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
</script>

</body>
</html>