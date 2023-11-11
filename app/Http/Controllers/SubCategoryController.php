<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategory = SubCategory::all();
         return view('admin.sub-category', compact('subcategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sub-category-create');
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
                'category_id'   => $request->category,
                'name'          => $request->name,
                'img'           => $image,
                'status'        => $request->status,
            ];

            SubCategory::create($data);

            return response()->json([
                'status'   => 'success',
                'message'  => 'SubCategory Add Successfull',
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
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        return view('admin.sub-category-edit', compact('subCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $validator   =  Validator::make($request->all(), [
                'category'      => 'required',
                'name'          => 'required',
                'status'        => 'required'
            ]);
            
            if ($validator->fails())
            {
                return response()->json(['status' => 'errors', 'message'=>$validator->errors()->all()]);
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
                'category_id'   => $request->category,
                'name'          => $request->name,
                'img'           => $image,
                'status'        => $request->status,
            ];

            SubCategory::where('id', $id)->update($data);

            return response()->json([
                'status'   => 'success',
                'message'  => 'SubCategory Update Successfull',
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
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            $save = SubCategory::where('id', $id)->delete();
            if($save){
             return response()->json([
                 'status'   => 'success',
                 'message'  => 'SubCategory Delete Successfull',
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
}
