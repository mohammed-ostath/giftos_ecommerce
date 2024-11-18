<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;


class AdminController extends Controller
{
    public function view_category(){
        // Get all categories
        $categories = Category::all();
        return view('admin.category',compact('categories'));
    }


    public function add_category(Request $request)
    {
        Category::create($request->all());
        return redirect()->back()->with('success', 'Category added successfully');
    }

    public function edit_category($id){
        $category = Category::find($id);
        return view('admin.edit_category',compact('category'));
    }

    public function update_category(Request $request, $id){
        $category = Category::find($id);
        $category->update($request->all());
        return redirect('view_category')->with('success', 'Category updated successfully');
    }

    public function delete_category($id){
        Category::find($id)->delete();
        return redirect()->back()->with('danger', 'Category deleted successfully');
    }

    public function add_product(){
        $categories = Category::all();
        return view('admin.add_product',compact('categories'));
    }

    public function upload_product(Request $request)
    {
        // Validation
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|string', // category name is passed as a string
            'quantity' => 'required|integer|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // validates uploaded image
        ]);

        // Handle image upload
        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $imageName);

        // Create product instance and save data
        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id; // matches the category selection
        $product->quantity = $request->quantity;
        $product->image = $imageName; // stores image name in database
        $product->save();

        return redirect()->back()->with('success', 'Product added successfully');
    }

    public function view_product(){
        $products = Product::with('category')->get();
        return view('admin.view_product',compact('products'));
    }

    public function edit_product($id){
        $product = Product::with('category')->find($id);
        $categories = Category::all();
        return view('admin.edit_product',compact('product','categories'));
    }

    public function update_product(Request $request, $id){
    $product = Product::findOrFail($id);
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'category_id' => 'required|integer',
        'quantity' => 'required|integer|min:1',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $product->title = $request->title;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->category_id = $request->category_id;
    $product->quantity = $request->quantity;

    if ($request->hasFile('image')) {
        if ($product->image && file_exists(public_path('images/' . $product->image))) {
            unlink(public_path('images/' . $product->image));
        }

        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $imageName);
        $product->image = $imageName;
    }

    // Save updated product
    $product->save();

    return redirect('view_product')->with('success', 'Product updated successfully');
}

    public function delete_product($id){
    $product = Product::findOrFail($id);

    if ($product->image && file_exists(public_path('images/' . $product->image))) {
        unlink(public_path('images/' . $product->image));
    }
    $product->delete();

    return redirect()->back()->with('success', 'Product deleted successfully');
}

public function product_search(Request $request){
    $search = $request->search;
    $products = Product::where('title', 'LIKE', '%'. $search. '%')->with('category')->get();
    return view('admin.view_product', compact('products'));
}

// public function product_details($id){
//     $products = Product::with('category')->find($id);
//     return view('admin.product_details',compact('products'));
// }



}
