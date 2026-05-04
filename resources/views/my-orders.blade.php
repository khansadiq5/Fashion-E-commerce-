<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders | Viora</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#f6f1ea] text-[#160c05]">

<section class="px-4 sm:px-6 lg:px-14 py-10">

    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-5 mb-8">
        <div>
            <p class="text-xs uppercase tracking-[0.35em] text-[#8b7462] mb-3">
                Order History
            </p>
            <h1 class="text-4xl sm:text-5xl font-semibold">
                My Orders
            </h1>
            <p class="mt-4 text-sm text-[#2f251e]/70">
                View your previous purchases and track order status.
            </p>
        </div>

        <a href="{{ url('collection') }}" class="w-fit bg-[#1b0d03] text-white px-6 py-3 text-xs uppercase tracking-[0.16em] font-semibold">
            Continue Shopping
        </a>
    </div>

    @if($orders->count() > 0)
        <div class="bg-[#fbf8f4] border border-[#eadfd3] overflow-hidden">

            <div class="hidden md:grid grid-cols-[1.2fr_1fr_1fr_1fr_0.8fr] gap-4 px-6 py-4 border-b border-[#eadfd3] text-xs uppercase tracking-[0.22em] text-[#8b7462]">
                <p>Order ID</p>
                <p>Total</p>
                <p>Date</p>
                <p>Status</p>
                <p class="text-right">Action</p>
            </div>

            @foreach($orders as $order)
                <div class="grid grid-cols-1 md:grid-cols-[1.2fr_1fr_1fr_1fr_0.8fr] gap-4 px-6 py-5 border-b border-[#eadfd3] last:border-b-0 items-center">

                    <div>
                        <p class="md:hidden text-xs uppercase tracking-[0.2em] text-[#8b7462] mb-1">Order ID</p>
                        <p class="font-semibold">
                            {{ $order->order_number }}
                        </p>
                    </div>

                    <div>
                        <p class="md:hidden text-xs uppercase tracking-[0.2em] text-[#8b7462] mb-1">Total</p>
                        <p class="font-semibold">
                            ₹{{ $order->total_amount }}
                        </p>
                    </div>

                    <div>
                        <p class="md:hidden text-xs uppercase tracking-[0.2em] text-[#8b7462] mb-1">Date</p>
                        <p class="text-sm text-[#2f251e]/70">
                            {{ $order->created_at->format('d M Y') }}
                        </p>
                    </div>

                    <div>
                        <p class="md:hidden text-xs uppercase tracking-[0.2em] text-[#8b7462] mb-1">Status</p>

                        <span class="inline-flex px-4 py-2 text-xs uppercase tracking-[0.14em] 
                            @if($order->order_status == 'delivered') bg-green-100 text-green-700
                            @elseif($order->order_status == 'cancelled') bg-red-100 text-red-700
                            @elseif($order->order_status == 'shipped') bg-blue-100 text-blue-700
                            @else bg-[#fff2e5] text-[#7a4d2a]
                            @endif">
                            {{ ucfirst($order->order_status) }}
                        </span>
                    </div>

                    <div class="md:text-right">
                        <a href="{{ url('my-orders/'.$order->id) }}" class="inline-flex bg-[#1b0d03] text-white px-5 py-3 text-xs uppercase tracking-[0.14em] font-semibold">
                            View
                        </a>
                    </div>

                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $orders->links() }}
        </div>
    @else
        <div class="bg-[#fbf8f4] border border-[#eadfd3] p-12 text-center">
            <h2 class="text-3xl font-semibold">No Orders Yet</h2>
            <p class="mt-3 text-[#8b7462]">
                You have not placed any order yet.
            </p>
            <a href="{{ url('collection') }}" class="mt-7 inline-flex bg-[#1b0d03] text-white px-8 py-4 uppercase tracking-[0.16em] text-xs font-semibold">
                Start Shopping
            </a>
        </div>
    @endif

</section>

</body>
</html>