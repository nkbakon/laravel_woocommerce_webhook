<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use Automattic\WooCommerce\Client;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderLineItem;
use App\Models\ShippingLine;

class APIController extends Controller
{
    public function index()
    {      
        $orders = Order::orderBy('id', 'desc')->paginate(25);  
        return view('welcome', compact('orders'));
    }

    public function view(Order $order)
    {
        return view('view', compact('order'));
    }

    public function createOrders(Request $request)
    {
        try {
            $metaData = request()->headers;
            Log::channel('get_orders_api')->info("====get Orders header data === " . $metaData);
            $signature = $request->header('x-wc-webhook-signature');

            $payload = $request->getContent();
            $calculated_hmac = base64_encode(hash_hmac('sha256', $payload, 'Enter_Consumer_Secret_Here', true));

            if($signature != $calculated_hmac) {
                Log::channel('get_orders_api')->info("get orders signature not matched =======> " . json_encode($payload));
                abort(403);
            }
            Log::channel('get_orders_api')->info("signature matched get orders request received =======> " . json_encode($payload));
            $check_order = Order::where('order_id', $request->id)->first();
            if($check_order == null){
                $order = new Order;
                $order->order_id = $request->id;
                $order->status = $request->status;
                $order->currency = $request->currency;
                $order->date_created = $request->date_created;
                $order->date_modified = $request->date_modified;
                $order->discount_total = $request->discount_total;
                $order->shipping_total = $request->shipping_total;
                $order->total = $request->total;
                $order->customer_id = $request->customer_id;
                $order->order_key = $request->order_key;
                $order->payment_method = $request->payment_method;
                $order->payment_method_title = $request->payment_method_title;
                $order->transaction_id = $request->transaction_id;
                $order->customer_note = $request->customer_note;
                $order->save();

                $order_line_items = $request->line_items;
                if($order_line_items != null){
                    foreach($order_line_items as $line_item)
                    {
                        $order_line_item = new OrderLineItem;
                        $order_line_item->order_id = $request->id;
                        $order_line_item->line_item_id = $line_item["id"];
                        $order_line_item->product_id = $line_item["product_id"];
                        $order_line_item->name = $line_item["name"];
                        $order_line_item->variation_id = $line_item["variation_id"];
                        $order_line_item->quantity = $line_item["quantity"];
                        $order_line_item->subtotal = $line_item["subtotal"];
                        $order_line_item->total = $line_item["total"];
                        $order_line_item->sku = $line_item["sku"];
                        $order_line_item->price = $line_item["price"];
                        $order_line_item->save();
                    }                    
                }

                $billing = $request->billing;
                if($billing != null){
                    $billing_address = new Address;
                    $billing_address->order_id = $request->id;
                    $billing_address->type = 1; //billing address
                    $billing_address->first_name = $billing["first_name"];
                    $billing_address->last_name = $billing["last_name"];
                    $billing_address->company = $billing["company"];
                    $billing_address->address_1 = $billing["address_1"];
                    $billing_address->address_2 = $billing["address_2"];
                    $billing_address->city = $billing["city"];
                    $billing_address->state = $billing["state"];
                    $billing_address->postcode = $billing["postcode"];
                    $billing_address->country = $billing["country"];
                    $billing_address->email = $billing["email"];
                    $billing_address->phone = $billing["phone"];
                    $billing_address->save();
                }

                $shipping = $request->shipping;
                if($shipping != null){
                    $shipping_address = new Address;
                    $shipping_address->order_id = $request->id;
                    $shipping_address->type = 2; //shipping address
                    $shipping_address->first_name = $shipping["first_name"];
                    $shipping_address->last_name = $shipping["last_name"];
                    $shipping_address->company = $shipping["company"];
                    $shipping_address->address_1 = $shipping["address_1"];
                    $shipping_address->address_2 = $shipping["address_2"];
                    $shipping_address->city = $shipping["city"];
                    $shipping_address->state = $shipping["state"];
                    $shipping_address->postcode = $shipping["postcode"];
                    $shipping_address->country = $shipping["country"];
                    $shipping_address->phone = $shipping["phone"];
                    $shipping_address->save();
                }

                $shipping_lines = $request->shipping_lines;
                if($shipping_lines != null){
                    foreach($shipping_lines as $shipping_line)
                    {
                        $new_shipping_line = new ShippingLine;
                        $new_shipping_line->order_id = $request->id;
                        $new_shipping_line->shipping_line_id = $shipping_line["id"];
                        $new_shipping_line->method_title = $shipping_line["method_title"];
                        $new_shipping_line->method_id = $shipping_line["method_id"];
                        $new_shipping_line->total = $shipping_line["total"];
                        $new_shipping_line->save();
                    }                    
                }
                
            }else{
                Log::channel('get_orders_api')->info("createOrder order already exist order id =======> " . $request->id); 
            }
        } catch (\Exception $exception) {
            Log::channel('get_orders_api')->info("======== createOrders exception occured - " . $exception->getMessage() . ' - line - ' . $exception->getLine());
        }
    }

    public function updateOrders(Request $request)
    {
        try {
            $metaData = request()->headers;
            Log::channel('get_orders_api')->info("====get order update header data === " . $metaData);
            $signature = $request->header('x-wc-webhook-signature');

            $payload = $request->getContent();
            $calculated_hmac = base64_encode(hash_hmac('sha256', $payload, 'Enter_Consumer_Secret_Here', true));

            if($signature != $calculated_hmac) {
                Log::channel('get_orders_api')->info("get order update signature not matched =======> " . json_encode($payload));
                abort(403);
            }
            Log::channel('get_orders_api')->info("signature matched get order update request received =======> " . json_encode($payload));
        } catch (\Exception $exception) {
            Log::channel('get_orders_api')->info("======== updateOrders exception occured - " . $exception->getMessage() . ' - line - ' . $exception->getLine());
        }
    }

    public function createProducts(Request $request)
    {
        try {
            $metaData = request()->headers;
            Log::channel('get_orders_api')->info("====get products header data === " . $metaData);
            $signature = $request->header('x-wc-webhook-signature');

            $payload = $request->getContent();
            $calculated_hmac = base64_encode(hash_hmac('sha256', $payload, 'Enter_Consumer_Secret_Here', true));

            if($signature != $calculated_hmac) {
                Log::channel('get_orders_api')->info("get products signature not matched =======> " . json_encode($payload));
                abort(403);
            }
            Log::channel('get_orders_api')->info("signature matched get products request received =======> " . json_encode($payload));
        } catch (\Exception $exception) {
            Log::channel('get_orders_api')->info("======== createProducts exception occured - " . $exception->getMessage() . ' - line - ' . $exception->getLine());
        }
    }

    public function createCategory(Request $request)
    {
        try {
            $metaData = request()->headers;
            Log::channel('get_orders_api')->info("====get category header data === " . $metaData);
            $signature = $request->header('x-wc-webhook-signature');

            $payload = $request->getContent();
            $calculated_hmac = base64_encode(hash_hmac('sha256', $payload, 'Enter_Consumer_Secret_Here', true));

            if($signature != $calculated_hmac) {
                Log::channel('get_orders_api')->info("get category signature not matched =======> " . $payload);
                abort(403);
            }
            Log::channel('get_orders_api')->info("signature matched get category request received =======> " . $payload);
        } catch (\Exception $exception) {
            Log::channel('get_orders_api')->info("======== createCategory exception occured - " . $exception->getMessage() . ' - line - ' . $exception->getLine());
        }
    }

    public function getOrders(Request $request)
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
            $list = $woocommerce->get('orders');
            echo'<pre>';
            print_r($list);
            echo'</pre>';
        } catch (\Exception $exception) {
            Log::channel('get_orders_api')->info("======== createOrders exception occured - " . $exception->getMessage() . ' - line - ' . $exception->getLine());
        }
    }
}
