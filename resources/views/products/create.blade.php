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
                                    <h5 class="font-bold text-center text-black">New Product</h5><br>                
                                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div>
                                            <label for="name">Enter Product Name</label><br>
                                            <input type="text" name="name" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="product name" required>
                                        </div>
                                        @error('name') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
                                        <br>                                    
                                        <div>
                                            <label for="image">Product Image</label><br>
                                            <input type="file" name="image" accept=".png,.svg,.jpg,.jpeg" class="block w-80 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                        </div>
                                        @error('image') <span class="text-red-500 error">{{ $message }}</span><br> @enderror 
                                        <br>  
                                        <div>
                                            <label for="price">Product Selling Price</label><br>
                                            <input type="number" name="price" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="product selling price" required>
                                        </div>
                                        @error('price') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
                                        <br>
                                        <div>
                                            <label for="description">Product Description</label><br>
                                            <textarea name="description" id="description" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="product description"></textarea>
                                        </div>
                                        @error('description') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
                                        <br>
                                        <div>
                                            <label for="short_description">Short Description</label><br>
                                            <textarea name="short_description" id="short_description" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="short description"></textarea>
                                        </div>
                                        @error('short_description') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
                                        <br>
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-25">Save</button>                        
                                    </form>
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