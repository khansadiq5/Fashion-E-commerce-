<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success | Viora</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#f6f1ea] text-[#160c05]">

<section class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-14 py-12">

    <div class="w-full max-w-4xl bg-[#fbf8f4] border border-[#eadfd3] p-6 sm:p-10 lg:p-12 text-center">

        <div class="w-20 h-20 rounded-full bg-green-100 text-green-700 flex items-center justify-center mx-auto text-4xl mb-7">
            ✓
        </div>

        <p class="text-xs uppercase tracking-[0.35em] text-[#8b7462] mb-4">
            Order Confirmed
        </p>

        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-semibold leading-tight">
            Thank You For Your Order
        </h1>

        <p class="mt-5 text-sm sm:text-base text-[#2f251e]/70 leading-7 max-w-2xl mx-auto">
            Your order has been placed successfully. You can view this order anytime from My Orders.
        </p>

        <div class="mt-9 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-left">

            <div class="bg-[#f6f1ea] border border-[#eadfd3] p-5">
                <p class="text-xs uppercase tracking-[0.2em] text-[#8b7462] mb-2">
                    Order No
                </p>
                <p class="font-semibold break-all">
                    {{ $order->order_number }}
                </p>
            </div>

            <div class="bg-[#f6f1ea] border border-[#eadfd3] p-5">
                <p class="text-xs uppercase tracking-[0.2em] text-[#8b7462] mb-2">
                    Total
                </p>
                <p class="font-semibold">
                    ₹{{ $order->total_amount }}
                </p>
            </div>

            <div class="bg-[#f6f1ea] border border-[#eadfd3] p-5">
                <p class="text-xs uppercase tracking-[0.2em] text-[#8b7462] mb-2">
                    Payment
                </p>
                <p class="font-semibold">
                    {{ $order->payment_method }}
                </p>
            </div>

            <div class="bg-[#f6f1ea] border border-[#eadfd3] p-5">
                <p class="text-xs uppercase tracking-[0.2em] text-[#8b7462] mb-2">
                    Status
                </p>
                <p class="font-semibold">
                    {{ ucfirst($order->order_status) }}
                </p>
            </div>

        </div>

        <div class="mt-10 bg-[#1b0d03] text-white p-6 sm:p-8 text-left">
            <p class="text-xs uppercase tracking-[0.3em] text-[#e8c7ad] mb-5">
                Order Items
            </p>

            <div class="space-y-4">
                @foreach($order->items as $item)
                    <div class="flex items-center gap-4 border-b border-white/10 pb-4 last:border-b-0 last:pb-0">
                        <img 
                            src="{{ asset('uploads/products/'.$item->product_image) }}"
                            class="w-16 h-20 object-cover bg-white/10"
                            alt="{{ $item->product_name }}"
                        >

                        <div class="flex-1">
                            <h3 class="font-semibold">
                                {{ $item->product_name }}
                            </h3>

                            <p class="mt-1 text-sm text-white/60">
                                Qty: {{ $item->quantity }} × ₹{{ $item->price }}
                            </p>
                        </div>

                        <p class="font-semibold">
                            ₹{{ $item->subtotal }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-9 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ url('collection') }}"
               class="w-full sm:w-auto inline-flex justify-center bg-[#1b0d03] text-white px-8 py-4 uppercase tracking-[0.16em] text-xs font-semibold hover:bg-black transition">
                Continue Shopping
            </a>

            <a href="{{ url('my-orders') }}"
               class="w-full sm:w-auto inline-flex justify-center border border-[#1b0d03] text-[#1b0d03] px-8 py-4 uppercase tracking-[0.16em] text-xs font-semibold hover:bg-[#1b0d03] hover:text-white transition">
                My Orders
            </a>
        </div>

    </div>

</section>

</body>
</html>