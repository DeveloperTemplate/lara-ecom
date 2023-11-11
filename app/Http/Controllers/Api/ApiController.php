<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use Razorpay\Api\Api;
use App\Models\Banner;
use App\Models\Address;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{


    public function category(Request $request)
    {

        try {

            $category = Category::where('status', 'Active')->get();

            if (count($category) > 0) {
    
                foreach ($category as  $value) {
                     $data[] =[
                        'id'                => $value->id,
                        'name'              => $value->name,
                        'image'             => $value->img,
                        'count_sub_category'=> $value->subcategory->count()
                     ];
                }
    
                return response()->json([
                    'status'   => 200,
                    'message'  => 'Category List',
                    'data'     => $data,
                ]);
                
            }else{
    
                return response()->json([
                    'status'   => 400,
                    'message'  => 'No Record Found',
                ]);
            }

        } catch (\Throwable $th) {
                return response()->json([
                    'status'       => 400,
                    'message'      => 'Server Error Please try again'
                ]);
          }
          
    }

    public function sub_category(Request $request)
    {

        try {

            if($request->category_id == null){
                return response()->json([
                    'status'   => 400,
                    'message'  => 'Category Id is required'
                ]);
             }
    
            $SubCategory = SubCategory::where('status', 'Active')->where('category_id', $request->category_id)->get();
    
            if (count($SubCategory) > 0) {
    
                foreach ($SubCategory as  $value) {
                     $data[] =[
                        'id'                => $value->id,
                        'name'              => $value->name,
                        'category_id'       => $value->category_id,
                        'category_name'     => $value->category->name,
                        'image'             => $value->img,
                        'count_child_category'=> $value->childCategory->count()
                     ];
                }
    
                return response()->json([
                    'status'   => 200,
                    'message'  => 'Sub Category List',
                    'data'     => $data,
                ]);
                
            }else{
    
                return response()->json([
                    'status'   => 400,
                    'message'  => 'No Record Found',
                ]);
            }

        } catch (\Throwable $th) {
                return response()->json([
                    'status'       => 400,
                    'message'      => 'Server Error Please try again'
                ]);
          }

    }

    public function child_category(Request $request)
    {

        try {

            if($request->category_id == null){
                return response()->json([
                    'status'   => 400,
                    'message'  => 'Category Id is required'
                ]);
             }
    
             if($request->sub_category_id == null){
                return response()->json([
                    'status'   => 400,
                    'message'  => 'Sub Category Id is required'
                ]);
             }
    
            $childCategory = ChildCategory::where('status', 'Active')
                            ->where('category_id', $request->category_id)
                            ->where('sub_category_id', $request->sub_category_id)
                            ->get();
    
            if (count($childCategory) > 0) {
    
                foreach ($childCategory as  $value) {
    
                    $count = Product::where('child_category_id', $value->id)->where('category_id', $value->category_id)->where('sub_category_id', $value->sub_category_id)->count();
                    
                     $data[] =[
                        'id'                => $value->id,
                        'name'              => $value->name,
                        'image'             => $value->img,
                        'category_name'     => $value->category->name,
                        'sub_category_name' => $value->subCategory->name,
                        'category_id'       => $value->category_id,
                        'sub_category_id'   => $value->sub_category_id,
                        'count_product'     => $count
                     ];
                     
                }
    
                return response()->json([
                    'status'   => 200,
                    'message'  => 'Child Category List',
                    'data'     => $data,
                ]);
                
            }else{
    
                return response()->json([
                    'status'   => 400,
                    'message'  => 'No Record Found',
                ]);
            }

        } catch (\Throwable $th) {
                return response()->json([
                    'status'       => 400,
                    'message'      => 'Server Error Please try again'
                ]);
        }

    }

    public function banner(Request $request)
    {

        try {

            $bannar = Banner::where('status', 'Active')->get();

            if (count($bannar) > 0) {
    
                foreach ($bannar as  $value) {
                     $data[] =[
                        'id'                => $value->id,
                        'name'              => $value->name,
                        'image'             => $value->img,
                        'desc'              => $value->desc,
                        'category_id'       => $value->category_id,
                        'category_name'     => $value->category->name,
                        'sub_category_id'   => $value->sub_category_id,
                        'sub_category_name' => $value->subCategory->name,
                        'child_category_id' => $value->child_category_id,
                        'child_category_name' => $value->childCategory->name,
                     ];
                }
    
                return response()->json([
                    'status'   => 200,
                    'message'  => 'bannar List',
                    'data'     => $data,
                ]);
                
            }else{
    
                return response()->json([
                    'status'   => 400,
                    'message'  => 'No Record Found',
                ]);
            }

        } catch (\Throwable $th) {
                return response()->json([
                    'status'       => 400,
                    'message'      => 'Server Error Please try again'
                ]);
            }



    }


    public function product(Request $request)
    {

        try {

            if($request->category_id == null){
                return response()->json([
                    'status'   => 400,
                    'message'  => 'Category Id is required'
                ]);
             }
    
             $title_category         = '';
             $title_sub_category     =  '';
             $title_child_category   = '';
    
            if($request->category_id && $request->sub_category_id && $request->child_category_id){
    
                $product = Product::where('child_category_id', $request->child_category_id)->where('category_id', $request->category_id)->where('sub_category_id', $request->sub_category_id)->where('status', 'Active')->get();
            
                if($product){
                    $title_category         = $product[0]->category->name ?? '';
                    $title_sub_category     = $product[0]->subCategory->name ?? '';
                    $title_child_category   = $product[0]->childCategory->name ?? '';
        
                }
              
            }elseif($request->category_id && $request->sub_category_id){
               
                $product = Product::where('category_id', $request->category_id)->where('sub_category_id', $request->sub_category_id)->where('status', 'Active')->get();
           
                if($product){
                    $title_category         = $product[0]->category->name ?? '';
                    $title_sub_category     = $product[0]->subCategory->name ?? '';
                    $title_child_category   = '';
                }
              
    
            }elseif($request->category_id && $request->child_category_id){
               
                $product = Product::where('category_id', $request->category_id)->where('child_category_id', $request->child_category_id)->where('status', 'Active')->get();
           
                if($product){
                    $title_category         = $product[0]->category->name ?? '';
                    $title_sub_category     = '';
                    $title_child_category   = $product[0]->childCategory->name ?? '';
                }
              
    
            }elseif($request->sub_category_id && $request->child_category_id){
               
                $product = Product::where('sub_category_id', $request->sub_category_id)->where('child_category_id', $request->child_category_id)->where('status', 'Active')->get();
           
                if($product){
                    $title_category         = '';
                    $title_sub_category     = $product[0]->subCategory->name ?? '';
                    $title_child_category   = $product[0]->childCategory->name ?? '';
                }
              
    
            }elseif($request->category_id){
               
                $product = Product::where('category_id', $request->category_id)->where('status', 'Active')->get();
    
                if($product){
                    $title_category         = $product[0]->category->name ?? '';
                    $title_sub_category     = '';
                    $title_child_category   = '';
                }
    
             
           
            }elseif($request->sub_category_id){
               
                $product = Product::where('sub_category_id', $request->sub_category_id)->where('status', 'Active')->get();
    
                if($product){
                    $title_category         = '';
                    $title_sub_category     = $product[0]->subCategory->name ?? '';
                    $title_child_category   = '';
                }
    
             
           
            }elseif($request->child_category_id){
               
                $product = Product::where('child_category_id', $request->child_category_id)->where('status', 'Active')->get();
           
                if($product){
                    $title_category         = '';
                    $title_sub_category     = '';
                    $title_child_category   = $product[0]->childCategory->name ?? '';
                }
    
              
    
            }
    
    
            if (count($product) > 0) {
    
                foreach ($product as  $value) {
                     $data[] =[
                        'id'                => $value->id,
                        'name'              => $value->name,
                        'actual_price'      => $value->actual_price,
                        'discount_price'    => $value->discount_price,
                        'short_desc'        => $value->short_desc,
                        'desc'              => strip_tags($value->desc),
                        'category_id'       => $value->category_id,
                        'category_name'     => $value->category->name,
                        'sub_category_id'   => $value->sub_category_id,
                        'sub_category_name' => $value->subCategory->name,
                        'child_category_id' => $value->child_category_id,
                        'child_category_name' => $value->childCategory->name,
                        'image'             => $value->productImages[0]->img_path ?? '',
                     ];
                }
    
                return response()->json([
                    'status'                => 200,
                    'message'               => 'Product List',
                    'title_category'        => $title_category,
                    'title_sub_category'    => $title_sub_category,
                    'title_child_category'  => $title_child_category,
                    'data'     => $data,
                ]);
                
            }else{
    
                return response()->json([
                    'status'   => 400,
                    'message'  => 'No Record Found',
                ]);
            }

        } catch (\Throwable $th) {
                return response()->json([
                    'status'       => 400,
                    'message'      => 'Server Error Please try again'
                ]);
        }

    }


    public function product_details(Request $request)
    {

        try {

            if($request->product_id == null){
                return response()->json([
                    'status'   => 400,
                    'message'  => 'Product Id is required'
                ]);
             }
    
            $product = Product::where('id', $request->product_id)->where('status', 'Active')->get();
    
            if (count($product) > 0) {
    
                foreach ($product as  $value) {
                     $data =[
                        'id'                => $value->id,
                        'name'              => $value->name,
                        'actual_price'      => $value->actual_price,
                        'discount_price'    => $value->discount_price,
                        'short_desc'        => $value->short_desc,
                        'desc'              => strip_tags($value->desc),
                        'category_id'       => $value->category_id,
                        'category_name'     => $value->category->name,
                        'sub_category_id'   => $value->sub_category_id,
                        'sub_category_name' => $value->subCategory->name,
                        'child_category_id' => $value->child_category_id,
                        'child_category_name' => $value->childCategory->name,
                        'image'             => $value->productImages ?? '',
                     ];
                }
    
                return response()->json([
                    'status'                => 200,
                    'message'               => 'Product Details',
                    'data'     => $data,
                ]);
                
            }else{
    
                return response()->json([
                    'status'   => 400,
                    'message'  => 'No Record Found',
                ]);
            }

        } catch (\Throwable $th) {
                return response()->json([
                    'status'       => 400,
                    'message'      => 'Server Error Please try again'
                ]);
         }

    }


    public function search(Request $request)
    {

        try {

            $keyword     = $request->keyword;

            if($keyword){
               $product = Product::where(function ($query) use ($keyword) {
                   $query->where('name', 'like', '%' . $keyword . '%')
                       ->orwhere('actual_price', 'like', '%' . $keyword . '%')
                       ->orwhere('discount_price', 'like', '%' . $keyword . '%')
                       ->orWhereHas('category', function ($query) use ($keyword) {
                           $query->where('name', 'like', '%' . $keyword . '%');
                       })->orWhereHas('subCategory', function ($query) use ($keyword) {
                           $query->where('name', 'like', '%' . $keyword . '%');
                       })->orWhereHas('childCategory', function ($query) use ($keyword) {
                           $query->where('name', 'like', '%' . $keyword . '%');
                       });
               })->where('status', 'Active')->get();
            }else{
               $product = Product::where('status', 'Active')->get();
            }
   
            if(count($product) > 0){
   
               foreach ($product as  $value) {
                   $data[] =[
                      'id'                => $value->id,
                      'name'              => $value->name,
                      'actual_price'      => $value->actual_price,
                      'discount_price'    => $value->discount_price,
                      'short_desc'        => $value->short_desc,
                      'desc'              => strip_tags($value->desc),
                      'category_id'       => $value->category_id,
                      'category_name'     => $value->category->name,
                      'sub_category_id'   => $value->sub_category_id,
                      'sub_category_name' => $value->subCategory->name,
                      'child_category_id' => $value->child_category_id,
                      'child_category_name' => $value->childCategory->name,
                      'image'             => $value->productImages[0]->img_path ?? '',
                   ];
              }
   
               return response()->json([
                   'status'       => 200,
                   'message'      => 'Product Search',
                   'data'         => $data,
               ]);
       
            }else{
               return response()->json([
                   'status'   => 400,
                   'message'  => 'No Record Found',
               ]);
            }

        } catch (\Throwable $th) {
                return response()->json([
                    'status'       => 400,
                    'message'      => 'Server Error Please try again'
                ]);
        }

}


public function cart_add(Request $request)
{

    try {
        if($request->qty == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'Qty field is required'
            ]);
         }
    
         if($request->user_id == null){
            return response()->json([
                'status'   => 201,
                'message'  => 'Please Login'
            ]);
         }
    
         if($request->product_id == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'Product field is required'
            ]);
         }
    
        $cart = Cart::where('product_id', $request->product_id)->where('user_id', $request->user_id)->first();
    
        if($cart){
    
        if($request->qty > 0){
            $cart->qty = $request->qty;
            $cart->save();
            return response()->json([
             'status'       => 200,
             'message'      => 'Cart Update Successfully'
            ]);
         }
    
        if($request->qty == 0){
           $cart->delete();
           return response()->json([
            'status'       => 200,
            'message'      => 'Cart Remove Successfully'
           ]);
        }
    
        }
    
        $data = [
            'user_id'     => $request->user_id,
            'product_id'  => $request->product_id,
            'qty'         => $request->qty,
            'type'        => "All",
        ];
    
        Cart::create($data);
    
        return response()->json([
            'status'       => 200,
            'message'      => 'Add to Cart Successfully'
        ]);
    } catch (\Throwable $th) {
        return response()->json([
            'status'       => 400,
            'message'      => 'Server Error Please try again'
        ]);
    }


 
}


public function cart_view(Request $request)
{

    try {

        
    if($request->user_id == null){
        return response()->json([
            'status'   => 400,
            'message'  => 'User Id field is required'
        ]);
     }

    $cart = Cart::where('user_id', $request->user_id)->get();

    $adress = Address::where('user_id', $request->user_id)->where('status', 'Active')->first();

    if($adress){

        $adressData = [
            'id'            => $adress->id,
            'name'          => $adress->name,
            'mobile'        => $adress->mobile,
            'pin'           => $adress->pin,
            'state'         => $adress->state,
            'city'          => $adress->city,
            'house_no'      => $adress->house_no,
            'road_name'     => $adress->road_name,
            'landmark'      => $adress->landmark,
            'type'          => $adress->type,
        ];

    }else{

        $adressData = '';

    }

    if(count($cart) > 0){

        foreach ($cart as $value) {
            $data[] =[
                'product_id'        => $value->product->id,
                'name'              => $value->product->name,
                'qty'               => $value->qty,
                'actual_price'      => $value->product->actual_price * $value->qty,
                'discount_price'    => $value->product->discount_price * $value->qty,
                'short_desc'        => $value->product->short_desc,
                'image'             => $value->product->productImages[0]->img_path ?? '',
             ];
        }

        $key = 'discount_price';

        $final_price = [
            'sub_total'         => array_sum(array_column($data,$key)),
            'discount'          => 0,
            'delivery_charge'   => 0,
            'total_amount'      => array_sum(array_column($data,$key)),
        ];

        return response()->json([
            'status'       => 200,
            'message'      => 'Cart  View',
            'extra_data'   => $final_price,
            'address_data' => $adressData,
            'data'         => $data,
        ]);

    }else{
        return response()->json([
            'status'   => 400,
            'message'  => 'No Record Found'
        ]);
    }

    } catch (\Throwable $th) {
            return response()->json([
                'status'       => 400,
                'message'      => 'Server Error Please try again'
            ]);
    }

 
}


public function login(Request $request)
{

    try {

        if($request->mobile == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'Mobile field is required'
            ]);
         }
    
        $user = User::where('mobile', $request->mobile)->first();
    
    
        $otp = rand(1000, 9999);
    
        textLocalSendOTP($request->mobile, $otp);
    
        if($user){
    
            return response()->json([
                'status'   => 200,
                'message'  => 'Login Successfully',
                'user_id'  => $user->id,
                'otp'      => $otp
            ]);
    
        }else{
    
            $user =  User::create([
                'mobile'  => $request->mobile
            ]);
    
            $role = Role::find(2);
            
            $user->syncRoles([$role->id]);
    
            return response()->json([
                'status'   => 200,
                'message'  => 'OTP Send Successfully',
                'user_id'  => $user->id,
                'otp'      => $otp
            ]);
    
        }

    } catch (\Throwable $th) {
            return response()->json([
                'status'       => 400,
                'message'      => 'Server Error Please try again'
            ]);
    }
}


public function resend_otp(Request $request)
{

    try {

        if($request->mobile == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'Mobile field is required'
            ]);
         }
    
        $user = User::where('mobile', $request->mobile)->first();
    
        if($user){
    
            $otp = rand(1000, 9999);
    
            textLocalSendOTP($request->mobile, $otp);
    
            return response()->json([
                'status'   => 200,
                'message'  => 'OTP Send Successfully',
                'otp'      => $otp
            ]);
    
        }else{
    
            return response()->json([
                'status'   => 400,
                'message'  => 'Mobile number does not exist'
            ]);
    
        }

    } catch (\Throwable $th) {
            return response()->json([
                'status'       => 400,
                'message'      => 'Server Error Please try again'
            ]);
        }


}

public function save_address(Request $request)
{

    try {

        if($request->user_id == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'User Id field is required'
            ]);
         }
    
         if($request->name == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'Name field is required'
            ]);
         }
    
         if($request->mobile == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'Mobile field is required'
            ]);
         }
    
         if($request->pin == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'Pin field is required'
            ]);
         }
    
         if($request->state == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'State field is required'
            ]);
         }
    
         if($request->city == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'City field is required'
            ]);
         }
    
         if($request->house_no == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'House no field is required'
            ]);
         }
    
         if($request->road_name == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'Road name field is required'
            ]);
         }
    
         if($request->type == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'Type field is required'
            ]);
         }
    
         if($request->status == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'Status field is required'
            ]);
         }
    
            if(Address::where('user_id', $request->user_id)->count() > 0){
                Address::where('user_id', $request->user_id)->update(['status' => 'Inactive']);
            }
    
            Address::create([
                'user_id'       => $request->user_id,
                'name'          => $request->name,
                'mobile'        => $request->mobile,
                'pin'           => $request->pin,
                'state'         => $request->state,
                'city'          => $request->city,
                'house_no'      => $request->house_no,
                'road_name'     => $request->road_name,
                'landmark'      => $request->landmark,
                'type'          => $request->type,
                'status'        => $request->status
            ]);
    
    
            return response()->json([
                'status'   => 200,
                'message'  => 'Adresss Save Successfully'
            ]);
    

    } catch (\Throwable $th) {
            return response()->json([
                'status'       => 400,
                'message'      => 'Server Error Please try again'
            ]);
    }
}


public function update_address(Request $request)
{

    try {

        if($request->address_id == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'Address Id field is required'
            ]);
         }
    
        if($request->user_id == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'User Id field is required'
            ]);
         }
    
         if($request->name == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'Name field is required'
            ]);
         }
    
         if($request->mobile == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'Mobile field is required'
            ]);
         }
    
         if($request->pin == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'Pin field is required'
            ]);
         }
    
         if($request->state == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'State field is required'
            ]);
         }
    
         if($request->city == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'City field is required'
            ]);
         }
    
         if($request->house_no == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'House no field is required'
            ]);
         }
    
         if($request->road_name == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'Road name field is required'
            ]);
         }
    
         if($request->type == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'Type field is required'
            ]);
         }
    
         if($request->status == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'Status field is required'
            ]);
         }
    
            if(Address::where('user_id', $request->user_id)->count() > 0){
                Address::where('user_id', $request->user_id)->update(['status' => 'Inactive']);
            }
    
            Address::where('id', $request->address_id)->update([
                'name'          => $request->name,
                'mobile'        => $request->mobile,
                'pin'           => $request->pin,
                'state'         => $request->state,
                'city'          => $request->city,
                'house_no'      => $request->house_no,
                'road_name'     => $request->road_name,
                'landmark'      => $request->landmark,
                'type'          => $request->type,
                'status'        => $request->status
            ]);
    
            return response()->json([
                'status'   => 200,
                'message'  => 'Adresss Update Successfully'
            ]);
    

    } catch (\Throwable $th) {
            return response()->json([
                'status'       => 400,
                'message'      => 'Server Error Please try again'
            ]);
    }


}


public function address_list(Request $request)
{

    try {

        if($request->user_id == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'User Id field is required'
            ]);
         }

        $address = Address::where('user_id', $request->user_id)->get();

        if(count($address) > 0){
    
          foreach($address as $item){
    
            $data[] = [
                'id'            => $item->id,
                'user_id'       => $item->user_id,
                'name'          => $item->name,
                'mobile'        => $item->mobile,
                'pin'           => $item->pin,
                'state'         => $item->state,
                'city'          => $item->city,
                'house_no'      => $item->house_no,
                'road_name'     => $item->road_name,
                'landmark'      => $item->landmark,
                'type'          => $item->type,
                'status'        => $item->status
            ];
    
          }
    
          return response()->json([
            'status'        => 200,
            'message'       => 'Address List',
            'total_address' => count($address),
            'data'          => $data,
          ]);
    
        }else{

            return response()->json([
                'status'   => 400,
                'message'  => 'No Record Found'
            ]); 
        }

    } catch (\Throwable $th) {
            return response()->json([
                'status'       => 400,
                'message'      => 'Server Error Please try again'
            ]);
    }


}


public function address_check(Request $request)
{

    try {

        if($request->user_id == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'User Id field is required'
            ]);
         }

        $address = Address::where('user_id', $request->user_id)->count();

        if($address > 0){
            $check = 'Yes';
        }else{
            $check = 'No';
        }

        return response()->json([
            'status'        => 200,
            'message'       => 'Address',
            'has_address'   => $check,
          ]);


    } catch (\Throwable $th) {
            return response()->json([
                'status'       => 400,
                'message'      => 'Server Error Please try again'
            ]);
    }


}

public function address_delete(Request $request)
{

    try {

        if($request->address_id == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'Address Id field is required'
            ]);
         }

         Address::where('id', $request->address_id)->delete();

        return response()->json([
            'status'        => 200,
            'message'       => 'Address Delete Successfully'
        ]);


    } catch (\Throwable $th) {
            return response()->json([
                'status'       => 400,
                'message'      => 'Server Error Please try again'
            ]);
    }

}


public function order(Request $request)
{

    try {

        if($request->user_id == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'User Id field is required'
            ]);
        }

        if($request->booking_type == null){
            // $request->booking_type = COD, Online
            return response()->json([
                'status'   => 400,
                'message'  => 'Booking Type field is required'
            ]);
        }

        if($request->cart_type == null){
             // $request->cart_type = Only, All
            return response()->json([
                'status'   => 400,
                'message'  => 'Cart Type field is required'
            ]);
        }

        if($request->cart_type == 'All'){
          $cart_data = Cart::where('user_id', $request->user_id)->where('type', "All")->get();
        }else{
          $cart_data = Cart::where('user_id', $request->user_id)->where('type', 'Only')->get();
        }

        $address = Address::where('user_id', $request->user_id)
        ->where('status', 'Active')->first();

        if($address == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'Address is Empty'
            ]);
        }

        if(count($cart_data) > 0){
              foreach($cart_data as $item){
                $total_prics[]  = $item->product->discount_price;

              }

        }else{
            return response()->json([
                'status'   => 400,
                'message'  => 'Cart is Empty'
            ]);
        }

        $total_amount = array_sum($total_prics);
        $total_gst   = array_sum($total_prics)*setting('gst')->value/100;
        $net_total   = $total_amount + $total_gst;

    
        if($request->booking_type == 'Online'){

            if($request->payment_gateway_id == null){
                // Payment Gateway Id
                return response()->json([
                    'status'   => 400,
                    'message'  => 'Payment Gateway Id field is required'
                ]);

            }

            $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));

            if ($request->payment_gateway_id) {
                $payment = $api->payment->fetch($request->payment_gateway_id);

                if($payment->status != 'captured'){
                   $api->payment->fetch($request->payment_gateway_id)->capture(array('amount'=>$payment['amount'])); 
                }

            }

             if($payment->status == 'captured'){
                $order_status  = 'Success';
             }else{
                $order_status  = 'Failer';
             }

             $payment_gateway_id  = $request->payment_gateway_id;

        }else{
              $order_status  = 'Success';
              $payment_gateway_id  = null;
        }

        $order_data = [
            'user_id'               => $request->user_id,
            'order_id_generate'     => rand(100000, 999999),
            'name'                  => $address->name,
            'mobile'                => $address->mobile,
            'alter_mobile'          => $address->alter_mobile ?? null,
            'pin'                   => $address->pin,
            'state'                 => $address->state,
            'city'                  => $address->city,
            'house_no'              => $address->house_no,
            'road_name'             => $address->road_name,
            'landmark'              => $address->landmark,
            'address_type'          => $address->type,
            'amount'                => $total_amount,
            'discount'              => null,
            'gst'                   => $total_gst,
            'net_amount'            => $net_total,
            'payment_method'        => $payment->method ?? null,
            'payment_gateway_id'    => $payment_gateway_id,
            'booking_type'          => $request->booking_type,
            'order_status'          => $order_status,
        ];

        $order = Order::create($order_data);

        foreach($cart_data as $item){

            $order_detail_data = [
                'order_id'                  => $order->id,
                'seller_id'                 => null,
                'product_id'                => $item->product_id,
                'order_details_id_generate' => rand(10000000, 99999999),
                'name'                      => $item->product->name,
                'list_price'                => $item->product->actual_price,
                'selling_price'             => $item->product->discount_price,
                'extra_discount'            => null,
                'special_price'             => $item->product->discount_price,
                'shipping_fee'              => null,
                'total_amount'              => $item->product->discount_price,
                'status'                    => 'Pending',
            ];

            OrderDetail::create($order_detail_data);

            $item->delete();
        }
        
        return response()->json([
            'status'        => 200,
            'message'       => 'Order Placed Successfully'
        ]);

    } catch (\Throwable $th) {
        return response()->json([
            'status'       => 400,
            'message'      => 'Server Error Please try again'
        ]);
    }

}


public function order_list(Request $request)
{

    try {

        if($request->user_id == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'User Id field is required'
            ]);
         }

       $order =  Order::where('user_id', $request->user_id)->orderBy('id', 'desc')->get();

       if(count($order) > 0){
        foreach($order as $item){
            foreach($item->order_detail as $value){
                $data[]  = [
                    'id'            => $value->id,
                    'name'          => $value->name,
                    'img'           => $value->product->productImages[0]->img_path,
                    'status'        => $value->status,
               ];
            }
        }
 
         return response()->json([
             'status'       => 200,
             'message'      => 'Order List',
             'data'         => $data,
         ]);

       }

       return response()->json([
        'status'       => 400,
        'message'      => 'Your order is empty'
      ]);

    } catch (\Throwable $th) {
        return response()->json([
            'status'       => 400,
            'message'      => 'Server Error Please try again'
        ]);
    }

}




public function order_details(Request $request)
{

    try {

        if($request->user_id == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'User Id field is required'
            ]);
         }

         if($request->order_id == null){
            return response()->json([
                'status'   => 400,
                'message'  => 'Order Id field is required'
            ]);
         }

       $order =  OrderDetail::where('id', $request->order_id)->orderBy('id', 'desc')->first();

       if($order){

         $data  = [
            'id'            => $order->id,
            'name'          => $order->name,
            'img'           => $order->product->productImages[0]->img_path,
            'selling_price' => $order->selling_price,
            'extra_discount' => $order->extra_discount ?? 0,
            'shipping_fee'  => $order->shipping_fee ?? 0,
            'total_amount'  => $order->total_amount,
            'status'        => $order->status,
            'order_date'    => date('Y-M-d', strtotime($order->created_at)),
          ];

          $data_user  = [
            'name'          => $order->order->name,
            'mobile'        => $order->order->mobile,
            'pin'           => $order->order->pin,
            'state'         => $order->order->state,
            'city'          => $order->order->city,
            'house_no'      => $order->order->house_no,
            'road_name'     => $order->order->road_name,
            'landmark'      => $order->order->landmark,
            'address_type'  => $order->order->address_type,
          ];
     
        return response()->json([
            'status'       => 200,
            'message'      => 'Order Details',
            'data_order'   => $data,
            'data_user'    => $data_user,
        ]);

       }

       return response()->json([
        'status'       => 400,
        'message'      => 'Your order is empty'
       ]);

    } catch (\Throwable $th) {
        return response()->json([
            'status'       => 400,
            'message'      => 'Server Error Please try again'
        ]);
    }

}
    
}
