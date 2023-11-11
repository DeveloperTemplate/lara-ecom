<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = Banner::all();
        return view('admin.banner', compact('banner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner-create');
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
                'description'       => 'required',
                'category'          => 'required',
                'image'             => 'required|image|max:2048|mimes:jpg,jpeg,png,webp,svg',
                'status'            => 'required',
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
                    'name'              => $request->name,
                    'img'               => $image,
                    'desc'              => $request->description,
                    'category_id'       => $request->category,
                    'sub_category_id'   => $request->subcategory,
                    'child_category_id' => $request->child_category,
                    'status'            => $request->status,
                ];

                Banner::create($data);

                return response()->json([
                    'status'   => 'success',
                    'message'  => 'Banner Add Successfull',
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
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        return view('admin.banner-edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        try {

            $validator   =  Validator::make($request->all(), [
                'name'              => 'required',
                'description'       => 'required',
                'category'          => 'required',
                'status'            => 'required',
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
                'name'              => $request->name,
                'img'               => $image,
                'desc'              => $request->description,
                'category_id'       => $request->category,
                'sub_category_id'   => $request->subcategory ?? $request->oldsubcategory,
                'child_category_id' => $request->child_category ?? $request->old_child_category,
                'status'            => $request->status,
            ];

                Banner::where('id', $id)->update($data);

                return response()->json([
                    'status'   => 'success',
                    'message'  => 'Banner Update Successfull',
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
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $save = Banner::where('id', $id)->delete();

            if($save){
             return response()->json([
                 'status'   => 'success',
                 'message'  => 'Banner Delete Successfull',
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
