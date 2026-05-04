<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viora | Create Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#f6f1ea] text-gray-900">

<section class="min-h-screen grid grid-cols-1 lg:grid-cols-2">

    <!-- LEFT SIDE -->
    <div class="relative hidden lg:block min-h-screen overflow-hidden">
        <img 
        src="https://goldensandsboutique.com/cdn/shop/files/about1.jpg?v=1747726449&width=1080"
        class="absolute inset-0 w-full h-full object-cover object-center"
        >

        <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/25 to-black/10"></div>

        <div class="absolute top-8 xl:top-10 left-8 xl:left-10">
            <h2 class="text-white text-xl xl:text-2xl tracking-[0.35em] uppercase">Viora</h2>
        </div>

        <div class="absolute bottom-10 xl:bottom-12 left-8 xl:left-10 right-8 xl:right-10 text-white space-y-4">
            <p class="uppercase tracking-[0.4em] text-xs text-white/70">
                Spring / Summer Edit
            </p>

            <h1 class="text-3xl xl:text-5xl font-light leading-tight">
                Style made for every moment.
            </h1>

            <p class="text-sm text-white/75 max-w-md leading-6">
                Discover curated fashion pieces designed for modern everyday wear.
            </p>
        </div>
    </div>

    <!-- RIGHT SIDE -->
    <div class="relative min-h-screen flex items-center justify-center px-5 sm:px-8 md:px-12 lg:px-16 xl:px-20 py-10 sm:py-12">

        <!-- MOBILE LOGO -->
        <div class="absolute top-5 left-5 sm:top-6 sm:left-6 lg:hidden">
            <h2 class="text-base sm:text-lg tracking-[0.3em] uppercase">Viora</h2>
        </div>

        <div class="w-full max-w-md pt-12 lg:pt-0">

            <!-- HEADER -->
            <div class="mb-8 sm:mb-10 space-y-3">
                <p class="text-[10px] sm:text-xs uppercase tracking-[0.3em] sm:tracking-[0.35em] text-gray-500">
                    Member Access
                </p>

                <h1 class="text-3xl sm:text-4xl font-light leading-tight">
                    Create your account
                </h1>

                <p class="text-gray-500 text-sm leading-6">
                    Join Viora to explore curated fashion, track orders, and save your style.
                </p>
            </div>

            <!-- ERRORS -->
            @if ($errors->any())
                <div class="mb-6 border-l-2 border-red-500 bg-red-50 px-4 py-3 text-red-600 text-sm">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>— {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- FORM -->
            <form action="{{ url('register') }}" method="post" class="space-y-5 sm:space-y-6">
                @csrf

                <!-- NAME -->
                <div class="space-y-2">
                    <label class="text-[10px] sm:text-xs uppercase tracking-[0.22em] sm:tracking-[0.25em] text-gray-500">
                        Name
                    </label>
                    <input 
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Your name"
                        class="w-full border-b border-gray-300 bg-transparent py-3 text-sm sm:text-base outline-none focus:border-black transition"
                    >
                </div>

                <!-- EMAIL -->
                <div class="space-y-2">
                    <label class="text-[10px] sm:text-xs uppercase tracking-[0.22em] sm:tracking-[0.25em] text-gray-500">
                        Email
                    </label>
                    <input 
                        type="text"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="yourstyle@gmail.com"
                        class="w-full border-b border-gray-300 bg-transparent py-3 text-sm sm:text-base outline-none focus:border-black transition"
                    >
                </div>

                <!-- PHONE -->
                <div class="space-y-2">
                    <label class="text-[10px] sm:text-xs uppercase tracking-[0.22em] sm:tracking-[0.25em] text-gray-500">
                        Phone
                    </label>
                    <input 
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="+91 98765 43210"
                        class="w-full border-b border-gray-300 bg-transparent py-3 text-sm sm:text-base outline-none focus:border-black transition"
                    >
                </div>

                <!-- PASSWORD -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 sm:gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] sm:text-xs uppercase tracking-[0.22em] sm:tracking-[0.25em] text-gray-500">
                            Password
                        </label>
                        <input 
                            type="password"
                            name="password"
                            placeholder="Create secure password"
                            class="w-full border-b border-gray-300 bg-transparent py-3 text-sm sm:text-base outline-none focus:border-black transition"
                        >
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] sm:text-xs uppercase tracking-[0.22em] sm:tracking-[0.25em] text-gray-500">
                            Confirm
                        </label>
                        <input 
                            type="password"
                            name="Cpassword"
                            placeholder="Repeat password"
                            class="w-full border-b border-gray-300 bg-transparent py-3 text-sm sm:text-base outline-none focus:border-black transition"
                        >
                    </div>
                </div>

                <!-- BUTTON -->
                <button 
                    type="submit"
                    class="w-full mt-4 bg-gray-900 text-white py-4 uppercase tracking-[0.22em] sm:tracking-[0.25em] text-xs hover:bg-black transition"
                >
                    Join Viora
                </button>

                <!-- LOGIN -->
                <p class="text-sm text-gray-500 text-center mt-4">
                    Already with Viora?
                    <a href="{{ url('login') }}" class="text-gray-900 underline underline-offset-4">
                        Sign in
                    </a>
                </p>
            </form>

        </div>
    </div>

</section>

</body>
</html>,