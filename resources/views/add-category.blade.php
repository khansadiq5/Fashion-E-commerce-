<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viora | Add Category</title>

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
            <a href="{{ url('admin') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition">
                <i class="fa-solid fa-chart-line w-5"></i>
                Dashboard
            </a>

            <a href="{{ url('admin/product') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition">
                <i class="fa-solid fa-shirt w-5"></i>
                Products
            </a>

            <a href="{{ url('admin/category') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-white text-black">
                <i class="fa-solid fa-layer-group w-5"></i>
                Categories
            </a>

            <a href="{{ url('admin/orders') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition">
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
                    <h2 class="text-xl font-light">Add Category</h2>
                    <p class="text-xs text-gray-500">Create a new product category</p>
                </div>
            </div>

            <a href="{{ url('admin/category') }}" class="hidden sm:inline-flex items-center gap-2 text-sm text-gray-500 hover:text-black transition">
                <i class="fa-solid fa-arrow-left text-xs"></i>
                Back to Categories
            </a>
        </header>

        <!-- Content -->
        <div class="p-5 md:p-8">

            <!-- Page Header -->
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-5 mb-6">
                <div>
                    <a href="{{ url('admin/category') }}" class="inline-flex sm:hidden items-center gap-2 text-sm text-gray-500 hover:text-black transition mb-4">
                        <i class="fa-solid fa-arrow-left text-xs"></i>
                        Back to Categories
                    </a>

                    <p class="text-xs uppercase tracking-[0.3em] text-gray-500 mb-2">Collection</p>
                    <h1 class="text-3xl md:text-4xl font-light">Add New Category</h1>
                    <p class="mt-2 text-sm text-gray-500 max-w-2xl">
                        Create a category to organize products clearly across your Viora store.
                    </p>
                </div>

                <div class="bg-black text-white rounded-2xl px-5 py-4 w-full sm:w-fit">
                    <p class="text-xs uppercase tracking-[0.2em] text-white/50">Module</p>
                    <h3 class="mt-1 text-xl font-semibold">Categories</h3>
                </div>
            </div>

            <!-- Errors -->
            @if ($errors->any())
                <div class="mb-6 rounded-2xl border border-red-100 bg-red-50 px-5 py-4 text-red-700 text-sm">
                    <p class="font-semibold mb-2">
                        <i class="fa-solid fa-triangle-exclamation mr-2"></i>
                        Please fix the following errors:
                    </p>

                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('admin/category/add-category') }}" method="post">
                @csrf

                <div class="grid grid-cols-1 xl:grid-cols-[1fr_360px] gap-6 items-start">

                    <!-- Left Form -->
                    <div class="space-y-6">

                        <!-- Category Information -->
                        <div class="bg-white rounded-2xl border border-black/5 p-6 md:p-8 shadow-sm">
                            <div class="mb-7">
                                <p class="text-xs uppercase tracking-[0.25em] text-gray-500 mb-2">Step 01</p>
                                <h2 class="text-2xl font-light">Category Information</h2>
                                <p class="mt-2 text-sm text-gray-500">
                                    Add category name and description for better product grouping.
                                </p>
                            </div>

                            <div class="space-y-5">

                                <div>
                                    <label class="block text-xs uppercase tracking-[0.22em] text-gray-500 mb-3">
                                        Category Name
                                    </label>

                                    <input 
                                        type="text" 
                                        name="name" 
                                        value="{{ old('name') }}"
                                        placeholder="Men Wear"
                                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-4 outline-none focus:border-black transition"
                                    >
                                </div>

                                <div>
                                    <label class="block text-xs uppercase tracking-[0.22em] text-gray-500 mb-3">
                                        Description
                                    </label>

                                    <textarea 
                                        name="description" 
                                        rows="6" 
                                        placeholder="Write short category details..."
                                        class="w-full resize-none rounded-xl border border-gray-200 bg-white px-4 py-4 outline-none focus:border-black transition"
                                    >{{ old('description') }}</textarea>
                                </div>

                            </div>
                        </div>

                        <!-- Visibility -->
                        <div class="bg-white rounded-2xl border border-black/5 p-6 md:p-8 shadow-sm">
                            <div class="mb-7">
                                <p class="text-xs uppercase tracking-[0.25em] text-gray-500 mb-2">Step 02</p>
                                <h2 class="text-2xl font-light">Visibility Status</h2>
                                <p class="mt-2 text-sm text-gray-500">
                                    Control whether this category is visible on the user side.
                                </p>
                            </div>

                            <div>
                                <label class="block text-xs uppercase tracking-[0.22em] text-gray-500 mb-3">
                                    Status
                                </label>

                                <select 
                                    name="status"
                                    class="w-full rounded-xl border border-gray-200 bg-white px-4 py-4 outline-none focus:border-black transition"
                                >
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <!-- Right Sidebar -->
                    <aside class="space-y-6 xl:sticky xl:top-24">

                        <!-- Publish Card -->
                        <div class="bg-[#111111] text-white rounded-2xl p-6 shadow-sm">
                            <p class="text-xs uppercase tracking-[0.25em] text-white/40 mb-3">
                                Publish
                            </p>

                            <h2 class="text-2xl font-light mb-4">
                                Ready to add?
                            </h2>

                            <p class="text-sm text-white/60 leading-6 mb-6">
                                After saving, this category can be assigned to products and shown on the store.
                            </p>

                            <button 
                                type="submit"
                                class="w-full bg-white text-black rounded-xl px-5 py-4 text-sm font-semibold hover:bg-[#f6f1ea] transition"
                            >
                                <i class="fa-solid fa-plus mr-2"></i>
                                Add Category
                            </button>

                            <a href="{{ url('admin/category') }}"
                               class="mt-3 w-full inline-flex items-center justify-center rounded-xl border border-white/15 px-5 py-4 text-sm text-white/80 hover:bg-white hover:text-black transition">
                                Cancel
                            </a>
                        </div>

                        <!-- Tips -->
                        <div class="bg-white rounded-2xl border border-black/5 p-6 shadow-sm">
                            <p class="text-xs uppercase tracking-[0.25em] text-gray-500 mb-3">
                                Tip
                            </p>

                            <p class="text-sm text-gray-600 leading-6">
                                Keep category names short and clear. Examples: Men Wear, Women Wear, Kids Wear, Accessories.
                            </p>
                        </div>

                        <!-- Preview Card -->
                        <div class="bg-white rounded-2xl border border-black/5 p-6 shadow-sm">
                            <p class="text-xs uppercase tracking-[0.25em] text-gray-500 mb-3">
                                Category Preview
                            </p>

                            <div class="rounded-2xl bg-[#f6f1ea] border border-black/5 p-5">
                                <div class="w-12 h-12 rounded-xl bg-white border border-black/5 flex items-center justify-center mb-4">
                                    <i class="fa-solid fa-layer-group text-gray-600"></i>
                                </div>

                                <h3 class="font-semibold text-gray-900">
                                    New Collection
                                </h3>

                                <p class="mt-2 text-sm text-gray-500 leading-6">
                                    This category will help users browse related products easily.
                                </p>
                            </div>
                        </div>

                    </aside>

                </div>
            </form>

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