<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\category;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function viewadminproducts(){
        $category = category::orderBy('id', 'desc')->get();
        return view('admin.all-product', compact('category'));
    }
    public function openProducts(){
        $category = category::orderBy('id', 'desc')->get();
        return view('manager.products', compact('category'));
    }
    
    public function viewProducts()
    {
        $products = Product::orderBy('id','desc')->get();
        // dd($products);
        return response()->json(['products' => $products]);
    }

    public function addProduct(Request $request)
    {
        $image = null;
        $gallery = [];
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '-' . $imageFile->getClientOriginalName();
            $imageFile->move(public_path('products'), $imageName); 
            $image = 'products/' . $imageName;  
        }
    
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $galleryName = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('products'), $galleryName);  
                $gallery[] = 'products/' . $galleryName; 
            }
        }

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name . '-' . Str::random(10)),
            'product_cat' => $request->product_cat,
            'price' => $request->price,
            'old_price' => $request->old_price,
            'stock' => $request->stock,
            'image' => $image,
            'gallery' => json_encode($gallery), 
            'excerpt' =>  $request->excerpt,
            'descriptions' =>  $request->descriptions,
            'hot' =>  $request->hot,
            'popular' => $request->popular,
            'bestselling' => $request->bestselling,
            'justarrived' => $request->justarrived,
        ]);
    
        return response()->json([
            'status' => 200,
            'message'=>'<div class="alert alert-success confirm_msgs" role="alert">
                Products Updated Successsfully!
            </div>'
        ]);
    }
    


    public function editProduct(Request $request)
    {
        // dd($request->all());
        $product = Product::find($request->id);
        if ($request->name !== $product->name) {
            $product->name = $request->name;
            $product->slug = Str::slug($request->name . '-' . Str::random(10));
        }
        $product->product_cat = $request->product_cat;
        $product->price = $request->price;
        $product->old_price = $request->old_price;
        $product->stock = $request->stock;
        $product->hot = $request->hot;
        $product->popular = $request->popular;
        $product->bestselling = $request->bestselling;
        $product->justarrived = $request->justarrived;
        $product->excerpt = $request->excerpt;
        $product->descriptions = $request->descriptions;
        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            $imageFile = $request->file('image');
            $imageName = time() . '-' . $imageFile->getClientOriginalName();
            $imageFile->move(public_path('products'), $imageName); 
            $product->image = 'products/' . $imageName;
        }
        if ($request->hasFile('gallery')) {
            $gallery = [];
            foreach ($request->file('gallery') as $file) {
                $galleryName = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('products'), $galleryName); 
                $gallery[] = 'products/' . $galleryName;
            }
            $product->gallery = json_encode($gallery);
        }
        $product->save();
        return response()->json([
            'status' => 200,
            'message' => '<div class="alert alert-success confirm_msgs" role="alert">
                Product Updated Successfully!
            </div>'
        ]);
    }
    





    public function deleteProduct(Request $request)
    {
        $product = Product::find($request->id);
        if ($product) {
            if ($product->image && File::exists(public_path($product->image))) {
                File::delete(public_path($product->image));
            }
            if ($product->gallery) {
                $galleryImages = json_decode($product->gallery);
                foreach ($galleryImages as $image) {
                    if (File::exists(public_path($image))) {
                        File::delete(public_path($image));
                    }
                }
            }
            $product->delete();
            return response()->json([
                'status' => 200,
                'message' => '<div class="alert alert-danger confirm_msgs" role="alert">
                    Products Deleted Successfully!
                </div>'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Product not found'
            ]);
        }
    }

    public function updateStackComment(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:products,id',
            'stack_comment' => 'required|string|max:255',
        ]);
        $product = Product::find($request->id);
        $product->stack_comments = $request->stack_comment;
        $product->save();
        return response()->json([
            'status' => 200,
            'message'=>'<div class="alert alert-success confirm_msgs" role="alert">
                Your Comment Submitted Successfully!
            </div>'
        ]);
    }
    public function viewProductComment($id)
    {
        $product = Product::find($id);
        if ($product) {
            return response()->json([
                'status' => 200,
                'comment' => $product->stack_comments 
            ]);
        }
        return response()->json([
            'status' => 404,
            'message' => 'Product not found'
        ]);
    }

    public function updateStock(Request $request)
    {
        $product = Product::find($request->id);
        if (!$product) {
            return response()->json([
                'status' => 400,
                'message' => 'Product not found.'
            ]);
        }
        $product->stock = $request->stock;
        $product->stack_comments = 'None';  
        $product->updated_at = now();  
        $product->save();

        return response()->json([
            'status' => 200,
            'message'=>'<div class="alert alert-info confirm_msgs" role="alert">
                Your Stack Updated Successfully!
            </div>'
        ]);
    }

// Add to Cart
public function addToCart(Request $request)
{
    // Validate input
    $request->validate([
        'id' => 'required|integer',
        'quantity' => 'required|integer|min:1',
    ]);

    // Fetch the product from the database
    $product = DB::table('products')->where('id', $request->id)->first();

    // Check if the product exists and if the stock is sufficient
    if (!$product || $product->stock < $request->quantity) {
        return response()->json([
            'status' => 400,
            'message' => 'Invalid quantity or product unavailable.'
        ]);
    }

    // Retrieve the current cart from the session
    $cart = session()->get('cart', []);

    // Add or update the product in the cart
    if (isset($cart[$request->id])) {
        $cart[$request->id]['quantity'] += $request->quantity;
    } else {
        $cart[$request->id] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->quantity
        ];
    }

    // Save the updated cart back to the session
    session()->put('cart', $cart);

    // Return the updated cart count in the response
    return response()->json([
        'status' => 200,
        'cart_count' => count($cart), 
        'message'=>'<div class="alert alert-success confirm_msgs" role="alert">
                Item listed Successfully!
            </div>'
    ]);
}



// Checkout Page
public function checkout()
{
    if(session('cart')){
        $cart = session()->get('cart', []);
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


// Remove Item from Cart
public function removeFromCart(Request $request)
{
    $request->validate([
        'id' => 'required|integer',
    ]);

    $cart = session()->get('cart', []);

    if (isset($cart[$request->id])) {
        unset($cart[$request->id]);
        session()->put('cart', $cart);

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
