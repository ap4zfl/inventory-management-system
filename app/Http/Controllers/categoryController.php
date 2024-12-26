<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class categoryController extends Controller
{
    public function viewcategory()
    {
        $category = category::orderBy('id','desc')->get();
        return response()->json(['category' => $category]);
    }
    public function addcategory(Request $request)
    {
        $image = null;
        if ($request->hasFile('cat_image')) {
            $imageFile = $request->file('cat_image');
            $imageName = time() . '-' . $imageFile->getClientOriginalName();
            $imageFile->move(public_path('products'), $imageName); 
            $image = 'products/' . $imageName;  
        }
    

        category::create([
            'cat_name' => $request->cat_name,
            'cat_slug' => Str::slug($request->cat_name . '-' . Str::random(10)),
            'cat_image' => $image,
        ]);
    
        return response()->json([
            'status' => 200,
            'message'=>'<div class="alert alert-success confirm_msgs" role="alert">
                Category Added Successsfully!
            </div>'
        ]);
    }
    public function editcategory(Request $request)
    {
        // dd($request->all());
        $category = category::find($request->id);
        if ($request->editcat_name !== $category->editcat_name) {
            $category->cat_name = $request->name;
            $category->cat_slug = Str::slug($request->editcat_name . '-' . Str::random(10));
        }
        $category->cat_name = $request->editcat_name;
        if ($request->hasFile('editcat_image')) {
            $imageFile = $request->file('editcat_image');
            $imageName = time() . '-' . $imageFile->getClientOriginalName();
            $imageFile->move(public_path('products'), $imageName); 
            $category->cat_image = 'products/' . $imageName;
        }
        $category->save();
        return response()->json([
            'status' => 200,
            'message' => '<div class="alert alert-success confirm_msgs" role="alert">
                Products Updated Successfully!
            </div>'
        ]);
    }

    public function deletecategory(Request $request)
    {
        $category = category::find($request->id);
        if ($category) {
            if ($category->editcat_image && File::exists(public_path($category->editcat_image))) {
                File::delete(public_path($category->editcat_image));
            }
            $category->delete();
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
}
