<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Bitware</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo.png') }}">
        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.5/dist/flowbite.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/monolith.min.css"/>

        <!-- font-awesome icons -->
        <script src="https://kit.fontawesome.com/2d49de291b.js" crossorigin="anonymous"></script>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100"> 
            <div class="bg-white">                
                <main class="min-h-screen w-full bg-gray-100 border-l" style="overflow: hidden;">
                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900">
                                    <a href="{{ route('index') }}" title="back" class="inline-flex items-center px-4 py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150" ><i class="fa-solid fa-angles-left"></i></a><br><br>
                                    <br>
                                    <h5 class="font-bold text-left text-gray-900">Order Details</h5><br>
                                    <span class="text-lg text-gray-700">Order ID : #{{ $order->order_id }}</span><br>
                                    <span class="text-lg text-gray-700">Status : {{ $order->status }}</span><br>
                                    <span class="text-lg text-gray-700">Currency : {{ $order->currency }}</span><br>
                                    <span class="text-lg text-gray-700">Total Discount : {{ $order->discount_total }}</span><br>
                                    <span class="text-lg text-gray-700">Total Shipping : {{ $order->shipping_total }}</span><br>
                                    <span class="text-lg text-gray-700">Order Total : {{ $order->total }}</span><br>
                                    <span class="text-lg text-gray-700">Payment Method : {{ $order->payment_method_title }}</span><br>
                                    <span class="text-lg text-gray-700">Customer Note : {{ $order->customer_note }}</span><br>
                                    <span class="text-lg text-gray-700">Order Date : {{ \Carbon\Carbon::parse($order->date_created)->format('Y-m-d H:i:s') }}</span><br>
                                    <span class="text-lg text-gray-700">Last Modified Date : {{ \Carbon\Carbon::parse($order->date_modified)->format('Y-m-d H:i:s') }}</span><br><br><br>
                                    
                                    <h5 class="font-bold text-left text-gray-900">Order Line Items</h5><br>
                                    @php
                                        $order_line_items = App\Models\OrderLineItem::where('order_id', $order->order_id)->get();
                                    @endphp
                                    @if(sizeof($order_line_items) > 0)
                                    <div class="overflow-x-auto">
                                        <table class="w-full text-base text-left text-gray-700 dark:text-gray-400">
                                            <thead class="text-sm text-gray-800 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                                <tr class="">
                                                    <th class="py-3 px-4">
                                                        ID
                                                    </th>
                                                    <th class="py-3 px-4">
                                                        Product ID
                                                    </th>
                                                    <th class="py-3 px-4">
                                                        Name
                                                    </th>
                                                    <th class="py-3 px-4">
                                                        Quantity
                                                    </th>
                                                    <th class="py-3 px-4">
                                                        Sub-Total
                                                    </th>
                                                    <th class="py-3 px-4">
                                                        Total
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($order_line_items as $order_line_item)
                                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">                                    
                                                    <td class="py-3 px-4">
                                                        {{ $order_line_item->line_item_id }}
                                                    </td>
                                                    <td class="py-3 px-4">
                                                        {{ $order_line_item->product_id }}
                                                    </td>
                                                    <td class="py-3 px-4">
                                                        {{ $order_line_item->name }}
                                                    </td>
                                                    <td class="py-3 px-4">
                                                        {{ $order_line_item->quantity }}
                                                    </td>
                                                    <td class="py-3 px-4">
                                                        {{ $order_line_item->subtotal }}
                                                    </td>
                                                    <td class="py-3 px-4">
                                                        {{ $order_line_item->total }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table><br>
                                        <br>                    
                                    </div>
                                    @endif
                                    <br>
                                    @php 
                                        $billing = App\Models\Address::where('order_id', $order->order_id)->where('type', 1)->first();
                                        $shipping = App\Models\Address::where('order_id', $order->order_id)->where('type', 2)->first();
                                    @endphp
                                    <div class="flex justify-between">
                                        <p>
                                            <span class="font-semibold text-lg text-gray-700">Billing Address</span><br>
                                            First Name: {{ $billing->first_name }}
                                            Last Name: {{ $billing->last_name }},<br>
                                            Company: {{ $billing->company }},<br>
                                            Line 1: {{ $billing->address_1 }},<br>
                                            Line 2: {{ $billing->address_2 }},<br>
                                            City: {{ $billing->city }},<br>
                                            State: {{ $billing->state }},<br>
                                            Postal Code: {{ $billing->postcode }},<br>
                                            Country: {{ $billing->country }},<br>
                                            Email: {{ $billing->email }},<br>
                                            Phone: {{ $billing->phone }}
                                        </p>
                                        <p>
                                            <span class="font-semibold text-lg text-gray-700">Shipping Address</span><br>
                                            First Name: {{ $shipping->first_name }}
                                            Last Name: {{ $shipping->last_name }},<br>
                                            Company: {{ $shipping->company }},<br>
                                            Line 1: {{ $shipping->address_1 }},<br>
                                            Line 2: {{ $shipping->address_2 }},<br>
                                            City: {{ $shipping->city }},<br>
                                            State: {{ $shipping->state }},<br>
                                            Postal Code: {{ $shipping->postcode }},<br>
                                            Country: {{ $shipping->country }},<br>
                                            Email: {{ $shipping->email }},<br>
                                            Phone: {{ $shipping->phone }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>	
                </main>
            </diV>    
        </div>        
        <script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
        @stack('js')
    </body>
</html>