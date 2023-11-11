<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use Illuminate\Support\Facades\Validator;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $childcategory = ChildCategory::all();
        return view('admin.child-category', compact('childcategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.child-category-create');
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
                'name'          => 'required',
                'category'      => 'required',
                'subcategory'   => 'required',
                'image'         => 'required|mimes:jpg,jpeg,png,webp,svg',
                'status'        => 'required'
            ]);
            
            if ($validator->fails())
            {
                return response()->json(['status' => 'errors', 'message'=>$validator->errors()->all()]);
            }

            if(isset($request->image)){
                $file = $request->file('image');
                $new_file = rand().'_'.$file->getClientOriginalName();
                $destinationPath = public_path('admin/images');
                $file->move($destinationPath, $new_file);
                $image = url('/').'/admin/images/'.$new_file;
            }else{
                $image = null;
            }

            $data = [
                'category_id'       => $request->category,
                'sub_category_id'   => $request->subcategory,
                'name'              => $request->name,
                'img'               => $image,
                'status'            => $request->status
            ];

            ChildCategory::create($data);

            return response()->json([
                'status'   => 'success',
                'message'  => 'Child Category Add Successfull',
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
     * @param  \App\Models\ChildCategory  $childCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ChildCategory $childCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChildCategory  $childCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ChildCategory $childCategory)
    {
        return view('admin.child-category-edit', compact('childCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChildCategory  $childCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $validator   =  Validator::make($request->all(), [
                'category'   => 'required',
                'name'          => 'required',
                'status'        => 'required'
            ]);
            
            if ($validator->fails())
            {
                return response()->json(['status' => 'errors', 'message'=>$validator->errors()->all()]);
            }

            if(isset($request->subcategory)){
                $subCategory = $request->subcategory; 
            }else{
                $subCategory = $request->oldsubcategory; 
            }

            if(isset($request->image)){

                $validator   =  Validator::make($request->all(), [
                    'image'         => 'required|mimes:jpg,jpeg,png'
                ]);

                $file = $request->file('image');
                $new_file = rand().'_'.$file->getClientOriginalName();
                $destinationPath = public_path('admin/images');
                $file->move($destinationPath, $new_file);
                $image = url('/').'/admin/images/'.$new_file;
            }else{
                $image = $request->old_image;
            }
           
            $data = [
                'category_id'       => $request->category,
                'sub_category_id'   => $subCategory,
                'name'              => $request->name,
                'img'               => $image,
                'status'            => $request->status
            ];

            ChildCategory::where('id', $id)->update($data);

            return response()->json([
                'status'   => 'success',
                'message'  => 'ChildCategory Update Successfull',
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
     * @param  \App\Models\ChildCategory  $childCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            
            $save = ChildCategory::where('id', $id)->delete();
            if($save){
             return response()->json([
                 'status'   => 'success',
                 'message'  => 'ChildCategory Delete Successfull',
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

    public function sub_category_search(Request $request)
    {
       $subCategory = SubCategory::where('category_id', $request->id)->get();
       return view('admin.data.sub-category-data', compact('subCategory'))->render();
    }

    public function child_category_search(Request $request)
    {

        // dd($request->all());

       $childCategory = ChildCategory::where('category_id', $request->cat_id)->where('sub_category_id', $request->sub_id)->get();
       return view('admin.data.child-category-data', compact('childCategory'))->render();
    }

}
