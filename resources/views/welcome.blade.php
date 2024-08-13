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
                                <div class="overflow-x-auto">
                                    <table class="w-full text-base text-left text-gray-700 dark:text-gray-400 text-sm">
                                        <thead class="text-sm text-gray-800 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr class="">
                                                <th class="py-3 px-4">
                                                    ID
                                                </th>
                                                <th class="py-3 px-4">
                                                    Status
                                                </th>
                                                <th class="py-3 px-4">
                                                    Currency
                                                </th>
                                                <th class="py-3 px-4">
                                                    Discount
                                                </th>
                                                <th class="py-3 px-4">
                                                    Shipping
                                                </th>
                                                <th class="py-3 px-4">
                                                    Total
                                                </th>
                                                <th class="py-3 px-4">
                                                    Payment
                                                </th>
                                                <th class="py-3 px-4">
                                                    Date
                                                </th>
                                                <th class="py-3 px-4">
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orders as $order)
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">                                    
                                                <td class="py-3 px-4">
                                                    {{ $order->order_id }}
                                                </td>
                                                <td class="py-3 px-4">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium leading-4 bg-green-100 text-green-900 capitalize">
                                                        {{ $order->status }}
                                                    </span>                                   
                                                </td>
                                                <td class="py-3 px-4">
                                                    {{ $order->currency }}
                                                </td>
                                                <td class="py-3 px-4">
                                                    {{ $order->discount_total }}                                   
                                                </td>
                                                <td class="py-3 px-4">
                                                    {{ $order->shipping_total }}                                   
                                                </td>
                                                <td class="py-3 px-4">
                                                    {{ $order->total }}                                   
                                                </td>
                                                <td class="py-3 px-4">
                                                    {{ $order->payment_method }}                                   
                                                </td>
                                                <td class="py-3 px-4">
                                                    {{ \Carbon\Carbon::parse($order->date_created)->format('Y-m-d H:i:s') }}
                                                </td>                                             
                                                <td class="py-3 px-4 min-w-48">
                                                    <a href="{{ route('orders.view', $order) }}" title="view" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"><i class="fa-regular fa-folder-open"></i></a>
                                                    <a href="" title="edit" class="inline-flex items-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150"><i class="fa-solid fa-pen-to-square"></i></a>                    
                                                    <button type="button" value="{{ $order->id }}" title="delete" data-modal-toggle="deleteData" class="deleteBtn inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"><i class="fa-regular fa-trash-can"></i></button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="p-2 bg-gray-50">
                                        <div class="flex justify-end">
                                            {{ $orders->links() }}            
                                        </div>
                                    </div>
                                    <br>                                    
                                </div>
                            </div>
                        </div>
                        <h5 class="font-bold text-center text-black mt-4">New Product Category</h5><br>                
                        <form action="{{ route('products.category') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label for="name">Enter Category</label><br>
                                <input type="text" name="name" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="province/district/state" required>
                            </div>
                            @error('name') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
                            <br>
                            <div>
                                <label for="image">Category Image</label><br>
                                <input type="file" name="image" accept=".png,.svg,.jpg,.jpeg" class="block w-80 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            </div>
                            @error('image') <span class="text-red-500 error">{{ $message }}</span><br> @enderror 
                            <br>  
                            <button type="submit" class="disabled:opacity-25 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-25">Save</button>                        
                        </form><br>
                        <table class="w-full text-base text-left text-gray-700 dark:text-gray-400 text-sm">
                            <thead class="text-sm text-gray-800 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr class="">
                                    <th class="py-3 px-4">
                                        Name
                                    </th>
                                    <th class="py-3 px-4">
                                        Image
                                    </th>
                                    <th class="py-3 px-4">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            @php 
                                $product_categories = App\Models\ProductCategory::all();
                            @endphp
                            <tbody>
                                @foreach($product_categories as $product_category)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">                                    
                                    <td class="py-3 px-4">
                                        {{ $product_category->name }}
                                    </td>
                                    <td class="py-3 px-4">
                                        <img src="{{ asset('storage') }}/{{ $product_category->image }}" alt="picture" width="50px" height="50px">
                                    </td>                                          
                                    <td class="py-3 px-4 min-w-48">
                                        <a href="" title="view" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"><i class="fa-regular fa-folder-open"></i></a>
                                        <a href="" title="edit" class="inline-flex items-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150"><i class="fa-solid fa-pen-to-square"></i></a>                    
                                        <button type="button" value="{{ $product_category->id }}" title="delete" data-modal-toggle="deleteData" class="deleteBtn inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"><i class="fa-regular fa-trash-can"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table><br>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <div class="overflow-x-auto">
                                    <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Add New Product</a><br><br> 
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