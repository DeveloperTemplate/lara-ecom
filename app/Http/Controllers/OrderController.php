<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = OrderDetail::orderBy('id', 'desc')->get();
        return view('admin.order', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(OrderDetail $order)
    {
        return view('admin.order-details', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }


    

    public function order_get_status(Request $request)
    {
        $orderStatus = OrderDetail::where('id', $request->id)->first();

        return view('admin.data.order-status-data', compact('orderStatus'))->render();
    }

    public function order_status_update(Request $request)
    {
    
        OrderDetail::where('id',  $request->id)->update(['status' => $request->status]);

        return response()->json([
            'status'   => 'success',
            'message'  => 'Order Update Successfull',
            'type'     => 'update'
        ]);
    }

    public function notification()
    {
        $notification = [];
        return view('admin.push-notification', compact('notification'));
    }

    public function notification_create()
    {
      
        return view('admin.push-notification-create');
    }



    public function notification_send(Request $request) 
    {

        try {

            $validator   =  Validator::make($request->all(), [
                'title'         => 'required',
                'description'   => 'required',
                // 'type'          => 'required',
            ]);
    
    
            if(isset($request->image)){
                $file = $request->file('image');
                $new_file = rand().'_'.$file->getClientOriginalName();
                $destinationPath = public_path('images/notification');
                $file->move($destinationPath, $new_file);
                $photo = url('/').'/images/notification/'.$new_file;
            }else{
                $photo = null;
            }
    
    
            if ($validator->fails())
            {
                return response()->json(['status' => 'errors', 'message'=>$validator->errors()->all()]);
            }


            foreach(User::role('User')->where('device_id', '!=', null)->get() as $item){
    
                $offerData   = [
                    'device_id'     => $item->device_id,
                    'title'         => $request->title,
                    'description'   => $request->description,
                    'img'           => $photo
                ];
                
                offer_push_notification($offerData);

            }

            return response()->json([
                'status'   => 'success',
                'message'  => 'Notification Send Successfull',
                'type'     => 'store'
            ]);

        } catch (\Throwable $th) {

            return response()->json(['status' => 'error', 'message'=>'Server error please try again '.$th]);

        }

    }


    

    

    
}
