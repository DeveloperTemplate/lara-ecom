<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        
        return view('admin.category', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category-create');
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
                    'name'       => $request->name,
                    'img'        => $image,
                    'status'     => $request->status
                ];
    
    
                Category::create($data);

                return response()->json([
                    'status'   => 'success',
                    'message'  => 'Category Add Successfull',
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category-edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $validator   =  Validator::make($request->all(), [
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
                'name'      => $request->name,
                'img'        => $image,
                'status'     => $request->status
            ];
    
            Category::where('id', $id)->update($data);

            return response()->json([
                'status'   => 'success',
                'message'  => 'Category Update Successfull',
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $save = Category::where('id', $id)->delete();

            if($save){
             return response()->json([
                 'status' => 'success',
                 'message'  => 'Category Delete Successfull',
             ]);
            }else{
             return response()->json([
                 'status' => 'error',
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
