<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductSold;
use Illuminate\Support\Facades\Auth;
 
class ProductController extends Controller
{
    public function index(Request $request){
        $products = Product::orderBy('sold', 'ASC');
        if($request->sort == 'asc'){
            $products =  $products->orderBy('name', 'ASC')->get();
        }else if($request->sort == 'desc'){
            $products =  $products->orderBy('name', 'DESC')->get();
        }else{
            $products =  $products->orderBy('created_at', 'DESC')->orderBy('updated_at', 'DESC')->get();
        }
 
        return view('pages.products', compact('products'));
    }
 
    public function create(){
        return view('pages.create');
    }
 
    public function store(Request $request){
        if($request->price < 1){
            return back()->with('error', 'Minimum price is $. 1');
        }
         
        $file = $request->file('image');
        $fileName = 'product_' . time() . '.' . $file->extension();
        $file->move(public_path('assets/img'), $fileName);
 
        Product::create([
            'name' => $request->name,
            'image' => $fileName,
            'description' => $request->description,
            'price' => $request->price,
            'sold' => "0",
            'user_id' => Auth::user()->id,
        ]);
 
        return back()->with('success', 'Congratulations, your product has been successfully created. Wait until your product is sold');
    }
 
    public function buy($id){
        $product = Product::findOrFail($id);
 
        if($product->user_id == Auth::user()->id){
            return back()->with('error', "Purchase failed, you can't buy your own product");
        }
 
        ProductSold::create([
            'product_id' => $product->id,
            'buyer_id' => Auth::user()->id,
        ]);
 
        $product->update([
            'sold' => true,
        ]);
 
        return back()->with('success', 'Congratulations, the product has been purchased successfully');
    }
     
    public function my(){
        $products = Product::where('user_id', Auth::user()->id)->orderBy('sold', 'asc')->get();
        return view('pages.my', compact('products'));
    }
    public function destroy(Product $product)
    {
        // Check if the user is authorized to delete the product, you may add more validation as needed.
        if ($product->user_id !== Auth::user()->id) {
            return back()->with('error', "You are not authorized to delete this product.");
        }

        // Delete the product
        $product->delete();

        return redirect()->route('product.my')->with('success', 'Product deleted successfully.');
    }

    public function edit(Product $product)
{
    // Check if the user is authorized to edit this product.
    if ($product->user_id !== Auth::user()->id) {
        return back()->with('error', 'You are not authorized to edit this product.');
    }

    return view('pages.edit', compact('product'));
}

public function update(Request $request, Product $product)
{
    // Check if the user is authorized to update this product.
    if ($product->user_id !== Auth::user()->id) {
        return back()->with('error', 'You are not authorized to update this product.');
    }

    // Validate and update the product data
    $product->update([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
    ]);

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $fileName = 'product_' . time() . '.' . $file->extension();
        $file->move(public_path('assets/img'), $fileName);
        $product->update(['image' => $fileName]);
    }

    return redirect()->route('product.my')->with('success', 'Product updated successfully.');
}

}
