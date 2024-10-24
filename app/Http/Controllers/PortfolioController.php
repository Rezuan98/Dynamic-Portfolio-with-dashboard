<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Carbon;

use App\Models\Product;

class PortfolioController extends Controller
{
    public function addProduct(){
         
        return view('backend.features.image_upload');}
    

    public function insertProduct(Request $request)
    {
        
            // Validation for files
           
            // Retrieve multiple files
            $images = $request->file('product_image');
            if($images)
                foreach ($images as $img) {
                    // Save each image to 'public/product_images' folder
                    $imagePath = $img->store('/product_images', 'public');
                    
                    // Store each image path in database
                    Product::create([
                        'product_image' => $imagePath,
                    ]);
            }
    
            return redirect()->back();
    // public function storeProduct(Request $request) {
    //    dd($request);
    //     $request->validate([
          
    //         'multi_img.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048' // You can adjust the max size and allowed types
    //     ]);
    
    //     // Retrieve multiple files from the request
    //     $images = $request->file('multi_img');
    
    //     // Check if any files are uploaded
    //     if ($images) {
    //         foreach ($images as $img) {
    //             // Store each image in the 'public/product_images' directory
    //             $imagePath = $img->store('product_images', 'public');
    
    //             // Insert the image path into the database
    //             Product::create([
    //                 'product_name' => $imagePath, // Change the field to the correct column in your database
    //                 'created_at' => \Carbon\Carbon::now(),
    //             ]);
    //         }
    //     }
    
    //     // Redirect after successful upload
    //     return redirect()->route('dashboard');
    }
    
public function editProduct($id){

 $product= Product::findOrfail($id);

 return view('backend.features.edit_product',compact('product'));
}
public function updateProduct(Request $request,$id){

    dd($id);

    $images = $request->file('product_image');
    if($images)
        foreach ($images as $img) {
            // Save each image to 'public/product_images' folder
            $imagePath = $img->store('/product_images', 'public');
            
            // Store each image path in database
            Product::where('id',$id)->update([
                'product_image' => $imagePath,
            ]);
    }

    return redirect()->back();

}
    }
