<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details | Viora</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#f6f1ea] text-[#160c05]">

<section class="px-4 sm:px-6 lg:px-14 py-10">

    <div class="mb-8">
        <a href="{{ url('my-orders') }}" class="text-sm text-[#8b7462] hover:text-[#1b0d03]">
            ← Back to Orders
        </a>

        <p class="text-xs uppercase tracking-[0.35em] text-[#8b7462] mt-6 mb-3">
            Order Details
        </p>

        <h1 class="text-4xl sm:text-5xl font-semibold">
            {{ $order->order_number }}
        </h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-[1fr_360px] gap-8">

        <div class="space-y-5">
            <div class="bg-[#fbf8f4] border border-[#eadfd3] p-6">
                <h2 class="text-2xl font-semibold mb-5">
                    Products
                </h2>

                <div class="space-y-5">
                    @foreach($order->items as $item)
                        <div class="grid grid-cols-[90px_1fr] sm:grid-cols-[120px_1fr] gap-5 border-b border-[#eadfd3] pb-5 last:border-b-0">
                            <img 
                                src="{{ asset('uploads/products/'.$item->product_image) }}" 
                                class="w-full h-28 sm:h-36 object-cover bg-[#eee6dc]"
                                alt="{{ $item->product_name }}"
                            >

                            <div>
                                <h3 class="text-lg font-semibold">
                                    {{ $item->product_name }}
                                </h3>

                                <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-3 text-sm">
                                    <p>
                                        <span class="text-[#8b7462]">Price:</span>
                                        ₹{{ $item->price }}
                                    </p>

                                    <p>
                                        <span class="text-[#8b7462]">Qty:</span>
                                        {{ $item->quantity }}
                                    </p>

                                    <p class="font-semibold">
                                        <span class="text-[#8b7462]">Subtotal:</span>
                                        ₹{{ $item->subtotal }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <aside class="bg-[#1b0d03] text-white p-6 h-fit lg:sticky lg:top-8">
            <p class="text-xs uppercase tracking-[0.35em] text-[#e8c7ad] mb-4">
                Summary
            </p>

            <h2 class="text-3xl font-semibold mb-7">
                Order Info
            </h2>

            <div class="space-y-4 border-b border-white/10 pb-6">
                <div class="flex justify-between gap-4">
                    <span class="text-white/60">Total</span>
                    <span>₹{{ $order->total_amount }}</span>
                </div>

                <div class="flex justify-between gap-4">
                    <span class="text-white/60">Payment</span>
                    <span>{{ $order->payment_method }}</span>
                </div>

                <div class="flex justify-between gap-4">
                    <span class="text-white/60">Status</span>
                    <span>{{ ucfirst($order->order_status) }}</span>
                </div>

                <div class="flex justify-between gap-4">
                    <span class="text-white/60">Date</span>
                    <span>{{ $order->created_at->format('d M Y') }}</span>
                </div>
            </div>

            <div class="mt-6">
                <h3 class="font-semibold mb-3">Shipping Address</h3>
                <p class="text-sm leading-7 text-white/70">
                    {{ $order->full_name }} <br>
                    {{ $order->phone }} <br>
                    {{ $order->address }}, {{ $order->city }}, {{ $order->state }} - {{ $order->pincode }}
                </p>
            </div>
        </aside>

    </div>

</section>

</body>
</html>