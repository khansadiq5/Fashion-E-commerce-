<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viora | Contact Us</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#f6f1ea] text-[#160c05] overflow-x-hidden">

<!-- NAVBAR - CONTACT -->
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
            <a href="{{ url('about') }}" class="hover:text-[#7a4d2a] transition">About Us</a>
            <a href="{{ url('contact') }}" class="px-4 py-2 rounded-full bg-[#fff2e5] shadow-sm">Contact Us</a>
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
            <a href="{{ url('about') }}" class="block text-xl font-semibold tracking-[0.18em] uppercase">About</a>
            <a href="{{ url('contact') }}" class="block text-xl font-semibold tracking-[0.18em] uppercase text-[#7a4d2a]">Contact</a>
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

    <div class="relative px-4 sm:px-6 lg:px-14 py-16 sm:py-20 lg:py-24 text-center">
        <p class="text-xs uppercase tracking-[0.35em] text-[#8b7462] mb-5">
            Contact Viora
        </p>

        <h1 class="max-w-5xl mx-auto text-5xl sm:text-6xl lg:text-7xl font-semibold leading-tight tracking-tight">
            We’d Love To Hear From You
        </h1>

        <p class="mt-6 max-w-3xl mx-auto text-base sm:text-lg leading-8 text-[#2f251e]/75">
            Have a question about your order, product sizing, delivery, returns, or collaboration? Send us a message and our team will get back to you soon.
        </p>
    </div>
</section>

<!-- CONTACT FORM + INFO -->
<section class="px-4 sm:px-6 lg:px-14 py-16 sm:py-20 lg:py-24 bg-[#f6f1ea]">
    <div class="grid grid-cols-1 lg:grid-cols-[1.2fr_0.8fr] gap-10 lg:gap-14">

        <!-- Form -->
        <div class="bg-[#fbf8f4] border border-[#eadfd3] p-6 sm:p-10 lg:p-12">
            <p class="text-xs uppercase tracking-[0.3em] text-[#8b7462] mb-4">
                Send Message
            </p>

            <h2 class="text-3xl sm:text-4xl font-semibold">
                Get In Touch
            </h2>

            <form action="#" method="post" class="mt-9 space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs uppercase tracking-[0.2em] text-[#8b7462] mb-3">
                            Full Name
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            placeholder="Enter your name"
                            class="w-full bg-white border border-[#eadfd3] px-5 py-4 outline-none focus:border-[#1b0d03] transition"
                        >
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-[0.2em] text-[#8b7462] mb-3">
                            Email Address
                        </label>
                        <input 
                            type="email" 
                            name="email" 
                            placeholder="example@gmail.com"
                            class="w-full bg-white border border-[#eadfd3] px-5 py-4 outline-none focus:border-[#1b0d03] transition"
                        >
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs uppercase tracking-[0.2em] text-[#8b7462] mb-3">
                            Phone Number
                        </label>
                        <input 
                            type="text" 
                            name="phone" 
                            placeholder="+91 98765 43210"
                            class="w-full bg-white border border-[#eadfd3] px-5 py-4 outline-none focus:border-[#1b0d03] transition"
                        >
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-[0.2em] text-[#8b7462] mb-3">
                            Topic
                        </label>
                        <select 
                            name="topic"
                            class="w-full bg-white border border-[#eadfd3] px-5 py-4 outline-none focus:border-[#1b0d03] transition"
                        >
                            <option>Order Support</option>
                            <option>Product Inquiry</option>
                            <option>Returns & Exchange</option>
                            <option>Collaboration</option>
                            <option>Other</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-[0.2em] text-[#8b7462] mb-3">
                        Message
                    </label>
                    <textarea 
                        name="message" 
                        rows="6" 
                        placeholder="Write your message..."
                        class="w-full bg-white border border-[#eadfd3] px-5 py-4 outline-none resize-none focus:border-[#1b0d03] transition"
                    ></textarea>
                </div>

                <button class="w-full sm:w-auto bg-[#1b0d03] text-white px-10 py-4 uppercase tracking-[0.16em] text-xs font-semibold hover:bg-black transition">
                    Submit Message
                </button>
            </form>
        </div>

        <!-- Info -->
        <div class="space-y-6">
            <div class="bg-[#1b0d03] text-white p-8 sm:p-10">
                <p class="text-xs uppercase tracking-[0.3em] text-white/60 mb-4">
                    Support
                </p>
                <h3 class="text-3xl font-semibold">Customer Care</h3>
                <p class="mt-4 text-sm leading-7 text-white/70">
                    Our support team is available to help you with orders, delivery updates, product details and general questions.
                </p>
            </div>

            <div class="bg-[#fbf8f4] border border-[#eadfd3] p-8">
                <h4 class="text-xl font-semibold">Email Us</h4>
                <p class="mt-3 text-sm text-[#8b7462]">support@viora.com</p>
            </div>

            <div class="bg-[#fbf8f4] border border-[#eadfd3] p-8">
                <h4 class="text-xl font-semibold">Call Us</h4>
                <p class="mt-3 text-sm text-[#8b7462]">+91 98765 43210</p>
            </div>

            <div class="bg-[#fbf8f4] border border-[#eadfd3] p-8">
                <h4 class="text-xl font-semibold">Working Hours</h4>
                <p class="mt-3 text-sm text-[#8b7462]">Monday - Saturday, 10:00 AM - 7:00 PM</p>
            </div>
        </div>

    </div>
</section>

<!-- LOCATION / STORE SECTION -->
<section class="bg-[#fbf8f4] px-4 sm:px-6 lg:px-14 py-16 sm:py-20 lg:py-24">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-14 items-center">

        <div>
            <p class="text-xs uppercase tracking-[0.35em] text-[#8b7462] mb-5">
                Visit Our Studio
            </p>

            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-semibold leading-tight">
                A Space For Modern Fashion Inspiration
            </h2>

            <p class="mt-6 text-base sm:text-lg leading-8 text-[#2f251e]/75">
                Viora’s studio brings together curated collections, style inspiration, and personalized support for customers looking to build a refined wardrobe.
            </p>

            <div class="mt-8 space-y-4 text-sm text-[#2f251e]/75">
                <p><span class="font-semibold text-[#1b0d03]">Address:</span> Viora Fashion Studio, Vapi, Gujarat, India</p>
                <p><span class="font-semibold text-[#1b0d03]">Support:</span> support@viora.com</p>
                <p><span class="font-semibold text-[#1b0d03]">Phone:</span> +91 98765 43210</p>
            </div>
        </div>

        <div class="relative h-[380px] sm:h-[480px] bg-[#e8dac9] overflow-hidden">
            <img 
                src="https://images.unsplash.com/photo-1555529669-e69e7aa0ba9a?auto=format&fit=crop&w=1400&q=80"
                class="w-full h-full object-cover object-center opacity-90"
                alt="Viora Store"
            >

            <div class="absolute inset-0 bg-gradient-to-t from-black/45 via-black/10 to-transparent"></div>

            <div class="absolute bottom-6 left-6 right-6 bg-white/90 backdrop-blur-md p-6">
                <p class="text-xs uppercase tracking-[0.25em] text-[#8b7462] mb-2">
                    Location
                </p>
                <h3 class="text-2xl font-semibold">Vapi, Gujarat</h3>
            </div>
        </div>

    </div>
</section>

<!-- FAQ -->
<section class="bg-[#f6f1ea] px-4 sm:px-6 lg:px-14 py-16 sm:py-20 lg:py-24">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-12">
            <p class="text-xs uppercase tracking-[0.35em] text-[#8b7462] mb-4">
                Quick Answers
            </p>
            <h2 class="text-4xl sm:text-5xl font-semibold">
                Common Questions
            </h2>
        </div>

        <div class="space-y-4">
            <div class="bg-[#fbf8f4] border border-[#eadfd3] p-6">
                <h3 class="font-semibold text-lg">How long does delivery take?</h3>
                <p class="mt-3 text-sm leading-7 text-[#2f251e]/70">
                    Delivery time depends on your location, but most orders are delivered within 3–7 working days.
                </p>
            </div>

            <div class="bg-[#fbf8f4] border border-[#eadfd3] p-6">
                <h3 class="font-semibold text-lg">Can I return or exchange a product?</h3>
                <p class="mt-3 text-sm leading-7 text-[#2f251e]/70">
                    Yes, eligible products can be returned or exchanged according to our return policy.
                </p>
            </div>

            <div class="bg-[#fbf8f4] border border-[#eadfd3] p-6">
                <h3 class="font-semibold text-lg">How can I track my order?</h3>
                <p class="mt-3 text-sm leading-7 text-[#2f251e]/70">
                    Once your order is shipped, tracking details will be shared with you through email or message.
                </p>
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
            alt="Viora Contact"
        >
    </div>

    <div class="relative max-w-4xl">
        <p class="text-xs uppercase tracking-[0.35em] text-[#e8c7ad] mb-5">
            Still Need Help?
        </p>

        <h2 class="text-4xl sm:text-5xl lg:text-6xl font-semibold leading-tight">
            Our Team Is Ready To Support You
        </h2>

        <p class="mt-5 text-sm sm:text-base leading-7 text-white/70 max-w-2xl">
            Reach out anytime for product guidance, order support, or fashion assistance.
        </p>

        <a href="{{ url('collection') }}"
           class="mt-8 inline-flex items-center bg-[#e8c7ad] text-[#1b0d03] px-8 py-4 uppercase tracking-[0.14em] text-xs font-semibold hover:bg-white transition">
            Explore Collection
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