<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        return view('admin.product', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            $validator   =  Validator::make($request->all(), [
                'name'              => 'required',
                'slug'              => 'required',
                'meta_title'        => 'required',
                'meta_description'  => 'required',
                'short_description' => 'required',
                'description'       => 'required',
                'category'          => 'required',
                'image.*'           => 'required|image|max:2048|mimes:jpg,jpeg,png,webp,svg',
                'status'            => 'required',
                'actual_price'      => 'required',
                'discount_price'    => 'required'
            ]);
            
            if ($validator->fails())
            {
                return response()->json(['status' => 'errors', 'message'=>$validator->errors()->all()]);
            }

                

                $data = [
                    'name'              => $request->name,
                    'slug'              => $request->slug,
                    'actual_price'      => $request->actual_price,
                    'discount_price'    => $request->discount_price,
                    'desc'              => $request->description,
                    'short_desc'        => $request->short_description,
                    'meta_title'        => $request->meta_title,
                    'meta_desc'         => $request->meta_description,
                    'category_id'       => $request->category,
                    'sub_category_id'   => $request->subcategory,
                    'child_category_id' => $request->child_category,
                    'status'            => $request->status,
                ];

               $product = Product::create($data);

               if(isset($request->image)){
                foreach ($request->image as $value) {
                    $file = $value;
                    $new_file = rand().'_'.$file->getClientOriginalName();
                    $destinationPath = public_path('admin/images');
                    $file->move($destinationPath, $new_file);
                    $image = url('/').'/admin/images/'.$new_file;
                    ProductImage::create([
                        'img_path'      => $image,
                        'product_id'    => $product->id,
                    ]);
                   }
               }

                return response()->json([
                    'status'   => 'success',
                    'message'  => 'Product Add Successfull',
                    'type'     => 'store'
                ]);
                
         } catch (\Throwable $th) {
            return response()->json([
                'status'   => 'error',
                'message'  => 'Technical Problem Please try again',
            ]);
         }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.product-edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try {

            // dd($request->all());

            $validator   =  Validator::make($request->all(), [
                'name'              => 'required',
                'slug'              => 'required',
                'meta_title'        => 'required',
                'meta_description'  => 'required',
                'short_description' => 'required',
                'description'       => 'required',
                'category'          => 'required',
                'status'            => 'required',
                'actual_price'      => 'required',
                'discount_price'    => 'required'
            ]);
            
            if ($validator->fails())
            {
                return response()->json(['status' => 'errors', 'message'=>$validator->errors()->all()]);
            }

            // short_desc

                $data = [
                    'name'              => $request->name,
                    'actual_price'      => $request->actual_price,
                    'discount_price'    => $request->discount_price,
                    'desc'              => $request->description,
                    'short_desc'        => $request->short_description,
                    'meta_title'        => $request->meta_title,
                    'meta_desc'         => $request->meta_description,
                    'category_id'       => $request->category,
                    'sub_category_id'   => $request->subcategory ?? $request->oldsubcategory,
                    'child_category_id' => $request->child_category ?? $request->old_child_category,
                    'status'            => $request->status,
                ];

                Product::where('id', $id)->update($data);


                for ($i=0; $i < count($request->old_img); $i++) { 

                    if(isset($request->image[$i])){
                       $file = $request->image[$i];
                       $new_file = rand().'_'.$file->getClientOriginalName();
                       $destinationPath = public_path('admin/images');
                       $file->move($destinationPath, $new_file);
                       $image = url('/').'/admin/images/'.$new_file;
                       $img = $image;
                    }else{
                       $img = $request->old_img[$i];
                    }
   
                    $dataImg[] = [
                           'img_path'       => $img,
                           'product_id'     => $id,
                           'created_at'     => date('Y-m-d h:i:s'),
                           'updated_at'     => date('Y-m-d h:i:s'),
                    ];
      
               }

                ProductImage::where('product_id', $id)->delete();

                ProductImage::insert($dataImg);

                return response()->json([
                    'status'   => 'success',
                    'message'  => 'Product Update Successfull',
                    'type'     => 'update'
                ]);
                
         } catch (\Throwable $th) {
            return response()->json([
                'status'   => 'error',
                'message'  => 'Technical Problem Please try again',
            ]);
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            $save = Product::where('id', $id)->delete();
            if($save){
             return response()->json([
                 'status'   => 'success',
                 'message'  => 'Product Delete Successfull',
             ]);
            }else{
             return response()->json([
                 'status'   => 'error',
                 'message'  => 'Technical Problem Please try again',
             ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status'   => 'error',
                'message'  => 'You Can not delete is item because this item assign other table',
            ]);
        }

    }

    public function image_upload(Request $request)
    {
        $file = $request->file('upload');
        $new_file = rand().'_'.$file->getClientOriginalName();
        $destinationPath = public_path('admin/images');
        $file->move($destinationPath, $new_file);
        $image = url('/').'/admin/images/'.$new_file;

        return response()->json(['url' => $image]);
    }
    
    public function product_search(Request $request)
    {

        $Product = Product::where('id', 'like', "%" . $request->term['term'] . "%")->orwhere('name', 'like', "%" . $request->term['term'] . "%")->get(['id', 'name']);

        return response()->json([
            'data'     => $Product
        ]);
    }
    


    
}
