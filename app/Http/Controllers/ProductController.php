<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use Automattic\WooCommerce\Client;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function create()
    {
        return view('products.create');
    }

    public function category(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);        

        if($request->hasFile('image'))
        {
            $image = $request->image;
            $path_image = $image->store('images', 'public');
            $url_image = asset('storage/' . $path_image); 
        }
        $add_by = 1;
        $product_category = new ProductCategory();
        $product_category->name = $request->name;
        if($request->hasFile('image'))
        {
            $product_category->image = $path_image;
        }
        $product_category->add_by = $add_by;
        $product_category->save();

        $woocommerce = new Client(
        'Enter_Online_Store_URL_Here',
        'Enter_Consumer_Key_Here',
        'Enter_Consumer_Secret_Here',
        [
            'version' => 'wc/v3',
        ]
        );

        $data = [
            'name' => $request->name,
            'image' => [
                'src' => $url_image
            ]
        ];

        $list = $woocommerce->post('products/categories', $data);

        if($product_category){
            return redirect()->route('index')->with('status', 'Product category created successfully.');
        }
        return redirect()->route('index')->with('delete', 'Product category create faild, try again.');
    }

    public function createProduct(Request $request)
    {
        try {          

            $woocommerce = new Client(
            'Enter_Online_Store_URL_Here',
            'Enter_Consumer_Key_Here',
            'Enter_Consumer_Secret_Here',
            [
                'version' => 'wc/v3',
            ]
            );

            $data = [
                'name' => 'Premium Quality Test Product API 1',
                'type' => 'simple',
                'regular_price' => '21.99',
                'description' => 'test product via rest api by nkbakon.',
                'short_description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.',
                'categories' => [
                    [
                        'id' => 9
                    ],
                    [
                        'id' => 14
                    ]
                ]
            ];

            $list = $woocommerce->post('products', $data);
            echo'<pre>';
            print_r($list);
            echo'</pre>';
        } catch (\Exception $exception) {
            Log::channel('product_create')->info("======== createOrders exception occured - " . $exception->getMessage() . ' - line - ' . $exception->getLine());
        }
    }
}
