<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Cart is empty!');
        }

            $orderId = DB::table('orders')->insertGetId([
                'order_number' => uniqid('ORD-'),
                'total_amount' => array_reduce($cart, function ($sum, $item) {
                    return $sum + ($item['price'] * $item['quantity']);
                }, 0),
                'created_at' => now()
            ]);

    
            foreach ($cart as $productId => $item) {
                DB::table('order_items')->insert([
                    'order_id' => $orderId,
                    'product_id' => $productId,
                    'product_name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total_price' => $item['price'] * $item['quantity']
                ]);

                DB::table('products')
                    ->where('id', $productId)
                    ->decrement('stock', $item['quantity']);
            }

            // Generate PDF invoice
            $orderDetails = DB::table('orders')->where('id', $orderId)->first();
            $orderItems = DB::table('order_items')->where('order_id', $orderId)->get();

            $pdf = Pdf::loadView('invoice', compact('orderDetails', 'orderItems'));

            // Save PDF directly to public/invoices
            $fileName = $orderDetails->order_number . '.pdf';
            $pdfPath = public_path('invoices/' . $fileName);
            $pdf->save($pdfPath);

            DB::commit();

            session()->forget('cart');
            return response()->json([
                'status' => 200,
                'message' => 'Order placed successfully!',
                'pdf_path' => asset('invoices/' . $fileName)
            ]);

    }

        public function viewOrders()
        {
            $orders = DB::table('orders')->orderBy('created_at', 'desc')->get();
            return view('admin.orders', compact('orders'));
        }
        public function viewOrderDetails($id)
        {
            $order = DB::table('orders')->where('id', $id)->first();
            $orderItems = DB::table('order_items')->where('order_id', $id)->get();

            return view('admin.order-details', compact('order', 'orderItems'));
        }



        public function placeOrderfront(Request $request)
        {
            $cart = session()->get('cartfront', []);
    
            if (empty($cart)) {
                return redirect()->back()->with('error', 'Cart is empty!');
            }
    
                $orderId = DB::table('orders')->insertGetId([
                    'order_number' => uniqid('ORD-'),
                    'total_amount' => array_reduce($cart, function ($sum, $item) {
                        return $sum + ($item['price'] * $item['quantity']);
                    }, 0),
                    'created_at' => now()
                ]);
    
        
                foreach ($cart as $productId => $item) {
                    DB::table('order_items')->insert([
                        'order_id' => $orderId,
                        'product_id' => $productId,
                        'product_name' => $item['name'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'total_price' => $item['price'] * $item['quantity']
                    ]);
    
                    DB::table('products')
                        ->where('id', $productId)
                        ->decrement('stock', $item['quantity']);
                }
    
                // Generate PDF invoice
                $orderDetails = DB::table('orders')->where('id', $orderId)->first();
                $orderItems = DB::table('order_items')->where('order_id', $orderId)->get();
    
                $pdf = Pdf::loadView('invoice', compact('orderDetails', 'orderItems'));
    
                // Save PDF directly to public/invoices
                $fileName = $orderDetails->order_number . '.pdf';
                $pdfPath = public_path('invoices/' . $fileName);
                $pdf->save($pdfPath);
    
                DB::commit();
    
                session()->forget('cartfront');
                return response()->json([
                    'status' => 200,
                    'message' => 'Order placed successfully!',
                    'pdf_path' => asset('invoices/' . $fileName)
                ]);
    
        }

}
