<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.setting');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     */
    public function store(Request $request)
    {
        // dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {

        try {

                if($request->type == 'start_end_date'){

                    $validator   =  Validator::make($request->all(), [
                        'start_date'  => 'required',
                        'end_date'    => 'required',
                        'type'        => 'required'
                    ]);
                
                    if ($validator->fails())
                    {
                        return response()->json(['status' => 'errors', 'message'=>$validator->errors()->all()]);
                    }

                    Setting::where('id', $request->start_id)->update(['value'  => $request->start_date]);
                    Setting::where('id', $request->end_id)->update(['value'  => $request->end_date]);

                }else{

                    $validator   =  Validator::make($request->all(), [
                        'value'  => 'required',
                        'type'   => 'required'
                    ]);
                
                    if ($validator->fails())
                    {
                        return response()->json(['status' => 'errors', 'message'=>$validator->errors()->all()]);
                    }

                    Setting::where('id', $setting->id)->update(['value'  => $request->value]);

                }
    

                if($request->type == 'minimun_order_value'){
                    $msg = "Minimum Order Amount update successfull";
                }elseif($request->type == 'gst'){
                    $msg = "GST update successfull";
                }elseif($request->type == 'delivery_fee'){
                    $msg = "Delivery Fee update successfull";
                }
                
                return response()->json([
                    'status'   => 'success',
                    'message'  => $msg,
                    'type'     => 'update'
                ]);
                
         } catch (\Throwable $th) {
            return response()->json([
                'status'   => 'error',
                'message'  => 'Technical Problem Please try again '.$th
            ]);
         }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
