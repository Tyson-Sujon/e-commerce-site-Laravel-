<?php

namespace App\Http\Controllers;

use App\Models\Atrribute;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function Frontend()
    {
        $latests = Product::with('Atrribute')->latest()->limit(10)->get();
        // $master_carts = Cart::with(['GetColor', 'GetProduct', 'GetSize'])->get();
        return view('frontend.main', compact('latests'));
    }
    public function ProductDetails($slug, $id)
    {
        $products = Product::with(['Atrribute', 'getCategory', 'getSubCategory'])->findOrFail($id)->where('slug', $slug)->first();
        $reletedProduct = Product::with(['Atrribute', 'getCategory', 'getSubCategory'])->where('id', '!=', $id)->where('category_id', $products->category_id)->get();
        $attribute = Atrribute::with(['Products', 'getColor', 'getSize'])->where('product_id', $products->id)->get();
        $grouped = $attribute->groupBy('color_id');
        // return $grouped->all();
        return view('frontend.pages.product_details', compact(['products', 'reletedProduct', 'grouped']));
    }

    public function GetProduct($color_id, $product_id)
    {
        $output = '';
        $sizes = Atrribute::with(['Products', 'getColor', 'getSize'])->where('product_id', $product_id)->where('color_id', $color_id)->get();
        foreach ($sizes as $key => $size) {
            $output = $output . '<input type="radio" data-quantity="' . $size->quantity . '" id="size" data-price="' . $size->sale_price . '" class="sizeCheck m-1 @error(' . 'size_id' . ') is-invalid @enderror" name="size_id" value="' . $size->size_id . '"> <label for="size">  ' . $size->getSize->size_name . '  </label>';
        }
        // return response()->json($sizes);
        echo $output;
    }

    // function about()
    // {

    //     return view('pages.about', [
    //         'var' => 'About pages',
    //     ]);
    // }
    // function contact()
    // {

    //     return view('pages.contact', [
    //         'var' => 'Contact pages',
    //     ]);
    // }

}
