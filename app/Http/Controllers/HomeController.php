<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        $trendings = Product::orderBy('id', 'desc')->where('hot', 'Yes')->take(15)->get();
        $bestselling = Product::orderBy('id', 'desc')->where('bestselling','Yes')->get();
        $populars = Product::orderBy('id', 'desc')->where('popular', 'Yes')->take(15)->get();
        $justarrived = Product::orderBy('id', 'desc')->where('justarrived','Yes')->get();
        $peoplelooking = $trendings->take(5)
        ->merge($bestselling->take(5))
        ->merge($populars->take(5))
        ->merge($justarrived->take(5))
        ->unique('slug');
        return view('welcome', compact('categories','trendings','bestselling','populars','justarrived','peoplelooking'));
    }

    public function searchProducts(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->select('name', 'image', 'slug')
            ->get();
        return response()->json($products);
    }
    public function productdetail($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $categories = Category::orderBy('id', 'desc')->take(3)->get();
        $trendings = Product::orderBy('id', 'desc')->where('hot', 'Yes')->take(2)->get();
        $bestselling = Product::orderBy('id', 'desc')->where('bestselling','Yes')->take(2)->get();
        $populars = Product::orderBy('id', 'desc')->where('popular', 'Yes')->take(2)->get();
        $justarrived = Product::orderBy('id', 'desc')->where('justarrived','Yes')->take(2)->get();
        return view('product-details', compact('product','categories','trendings','bestselling','populars','justarrived'));
    }

    public function showcateProducts($slug)
    {
        $category = Category::where('cat_slug', $slug)->first();
        $trendings = Product::where('product_cat', $category->id)->get();
        return view('category-products', compact('category', 'trendings'));
    }
    public function shop()
    {
        $categories = Category::orderBy('id', 'desc')->get(); 
        return view('shop', compact('categories'));
    }
    
    public function fetchshopProducts(Request $request)
    {
        $query = Product::query();
        // Filter by categories
        if ($request->has('categories')) {
            $query->whereIn('product_cat', $request->categories);
        }
        // Filter by trending
        if ($request->has('trendings') && $request->trendings === 'Yes') {
            $query->where('hot', 'Yes');
        }
        // Filter by bestselling
        if ($request->has('bestselling') && $request->bestselling === 'Yes') {
            $query->where('bestselling', 'Yes');
        }
        // Filter by popular
        if ($request->has('popular') && $request->popular === 'Yes') {
            $query->where('popular', 'Yes');
        }
        // Filter by just arrived
        if ($request->has('justarrived') && $request->justarrived === 'Yes') {
            $query->where('justarrived', 'Yes');
        }
        // Sort by price
        if ($request->price === 'low_to_high') {
            $query->orderBy('price', 'asc');
        } elseif ($request->price === 'high_to_low') {
            $query->orderBy('price', 'desc');
        }
        // Sort by name
        if ($request->name === 'asc') {
            $query->orderBy('name', 'asc');
        } elseif ($request->name === 'desc') {
            $query->orderBy('name', 'desc');
        }
        // Get filtered products
        $products = $query->get();
        return response()->json($products);
    }
    
        public function addToCart(Request $request)
        {
            // dd($request->input());
            if (!Session::has('adviser')) {
                return response()->json(['status' => 'error', 'message' => 'User session not found. Please log in first.'], 403);
            }
            $cart = Session::get('cartfront', []);
            $cart[] = [
                'id' => $request->id,
                'name' => $request->name,
                'quantity' => $request->quantity,
                'price' => $request->price,
            ];
            Session::put('cartfront', $cart);
            return response()->json(['status' => 'success', 'message' => 'Product added to cart successfully!', 'cart' => $cart]);
        }

        public function getCart()
        {
            $cart = Session::get('cartfront', []);
            $total = array_sum(array_map(function ($item) {
                return (float)$item['price'] * (int)$item['quantity'];
            }, $cart));
            return response()->json(['cart' => $cart, 'total' => $total]);
        }
        public function checkout()
        {
            if(session('cartfront')){
                $cart = session()->get('cartfront', []);
                $totalBalance = array_reduce($cart, function ($sum, $item) {
                    return $sum + ($item['price'] * $item['quantity']);
                }, 0);
            
                return response()->json([
                    'cart' => $cart,
                    'total_balance' => $totalBalance
                ]);
            } else {
                return response()->json([
                    'cart' => [],
                    'total_balance' => 0
                ]);
            }
        }
        public function removeFromCart(Request $request)
        {
            $request->validate([
                'id' => 'required|integer',
            ]);

            $cart = session()->get('cartfront', []);

            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cartfront', $cart);

                $totalBalance = array_reduce($cart, function ($sum, $item) {
                    return $sum + ($item['price'] * $item['quantity']);
                }, 0);

                return response()->json([
                    'status' => 200,
                    'cart_count' => count($cart),
                    'total_balance' => $totalBalance,
                    'message'=>'<div class="alert alert-danger confirm_msgs" role="alert">
                    Item remove from cart.
                </div>'
                ]);
            }

            return response()->json([
                'status' => 400,
                'message' => 'Item not found in cart!'
            ]);
        }
    


}
