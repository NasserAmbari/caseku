<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManualOrder;
use Illuminate\Support\Facades\DB;
use PDF;

class ManualOrderController extends Controller
{
    public function ListManualOrder(Request $request){
        $order_source = DB::table('order_sources')->select('id','order_source')->where('order_sources.as','=','Manual')->get();
        $payment_method = DB::table('payment_methods')->select('id','payment_method')   ->get();
        $shipping_method = DB::table('shipping_methods')->select('id','shipping_method')->where('shipping_methods.as','=','Manual')->get();

        $searching = $request->searching;
        $start = $request->start;
        $end = $request->end;

        $field = ['code_order','contact','name','address','order_source','payment_method','shipping_method','note','status'];

        if(isset($searching) && !isset($start,$end)){
            $result = ManualOrder::select('manual_orders.id',
            'manual_orders.code_order',
            'manual_orders.name',
            'manual_orders.address',
            'manual_orders.contact',
            'order_sources.order_source',
            'payment_methods.payment_method',
            'shipping_methods.shipping_method',
            'manual_orders.note',
            'manual_orders.receipt_number',
            'manual_orders.status',
            'manual_orders.shipping_fee')
            ->join('order_sources','manual_orders.order_source_id','=','order_sources.id')
            ->join('shipping_methods','manual_orders.shipping_method_id','=','shipping_methods.id')
            ->join('payment_methods','manual_orders.payment_method_id','=','payment_methods.id')
            ->where(function($query) use($searching,$field,$start,$end){
                for($i = 0; $i < count($field); $i++){
                    $query->orWhere($field[$i], 'like',  '%' . $searching .'%');
                }
            })
            ->orderBy('manual_orders.created_at','desc')
            ->paginate(10);

            return view('superuser.order.ordermanual',[
                'order' => $result,
                'searching' => $searching,
                'order_source' => $order_source,
                'payment_method' =>$payment_method,
                'shipping_method' => $shipping_method
            ]);
        } else if(isset($request->searching) || isset($request->start) ){
            $result = ManualOrder::select('manual_orders.id',
            'manual_orders.code_order',
            'manual_orders.name',
            'manual_orders.address',
            'manual_orders.contact',
            'manual_orders.receipt_number',
            'order_sources.order_source',
            'payment_methods.payment_method',
            'shipping_methods.shipping_method',
            'manual_orders.note',
            'manual_orders.status',
            'manual_orders.shipping_fee')
            ->join('order_sources','manual_orders.order_source_id','=','order_sources.id')
            ->join('shipping_methods','manual_orders.shipping_method_id','=','shipping_methods.id')
            ->join('payment_methods','manual_orders.payment_method_id','=','payment_methods.id')
            ->where(function($query) use($searching,$field,$start,$end){
                for($i = 0; $i < count($field); $i++){
                    $query->orWhere($field[$i], 'like',  '%' . $searching .'%');
                }
            })
            ->whereBetween('date_create',[$start,$end])
            ->orderBy('manual_orders.created_at','desc')
            ->paginate(10);

            return view('superuser.order.ordermanual',[
                'order' => $result,
                'searching' => $searching,
                'start' => $start,
                'end' => $end,
                'order_source' => $order_source,
                'payment_method' =>$payment_method,
                'shipping_method' => $shipping_method
            ]);
        }

        $result = ManualOrder::select(
            'manual_orders.id',
            'manual_orders.code_order',
            'manual_orders.name',
            'manual_orders.address',
            'manual_orders.contact',
            'order_sources.order_source',
            'payment_methods.payment_method',
            'shipping_methods.shipping_method',
            'manual_orders.note',
            'manual_orders.receipt_number',
            'manual_orders.status',
            'manual_orders.shipping_fee')
            ->join('order_sources','manual_orders.order_source_id','=','order_sources.id')
            ->join('shipping_methods','manual_orders.shipping_method_id','=','shipping_methods.id')
            ->join('payment_methods','manual_orders.payment_method_id','=','payment_methods.id')
            ->orderBy('manual_orders.created_at','desc')
            ->paginate(10);

        return view('superuser.order.ordermanual',[
            'order' => $result,
            'order_source' => $order_source,
            'payment_method' =>$payment_method,
            'shipping_method' => $shipping_method
            ]);
    }

    public function StoreManualOrderData(Request $request){
        try {
            DB::beginTransaction();
            $code_order = $request->user.'-'.date('Y/m/d-H:i:s');
            $result = DB::table('manual_orders')->insert([
                'code_order'         => $code_order,
                'name'               => $request->name,
                'address'            => $request->address,
                'contact'            => $request->contact,
                'order_source_id'    => $request->ordersource,
                'payment_method_id'  => $request->paymentmethod,
                'shipping_method_id' => $request->shippingmethod,
                'user_id'            => $request->userid,
                'date_create'        => date("Y-m-d"),
                'created_at'         => \Carbon\Carbon::now(), 
                'updated_at'         => \Carbon\Carbon::now(),
                'note'               => $request->note,
                'receipt_number'     => $request->receiptnumber
            ]);

            DB::commit();

            if($result){
                toastr()->success('New Manual Order : '.$request->code_order.' has been added');
                return redirect()->back();
            }
        } catch (\Exception $ex) {
            DB::rollback();
            toastr()->error('Error : '.json_encode($ex));
            return redirect()->back();
        }
    }

    public function GetManualOrderData(Request $request){
        $result = ManualOrder::select('manual_orders.id',
            'manual_orders.name',
            'manual_orders.contact',
            'manual_orders.address',
            'manual_orders.order_source_id',
            'manual_orders.payment_method_id',
            'manual_orders.shipping_method_id',
            'manual_orders.shipping_fee',
            'manual_orders.receipt_number',
            'manual_orders.note')
            ->where('manual_orders.id',$request->id)
            ->get();
        if($result){
            return response()->json($result[0]);
        }
    }

    public function UpdateManualOrderData(Request $request){
        try {
            DB::beginTransaction();
            
            $result = DB::table('manual_orders')
                ->where('id',$request->id)
                ->update([
                    'name'               => $request->name,
                    'address'            => $request->address,
                    'contact'            => $request->contact,
                    'order_source_id'    => $request->ordersource,
                    'payment_method_id'  => $request->paymentmethod,
                    'shipping_method_id' => $request->shippingmethod,
                    'receipt_number'     => $request->receiptnumber,
                    'updated_at'         => \Carbon\Carbon::now(),
                    'note'               => $request->note, 
                    'shipping_fee'       => $request->shippingfee
                ]);
                
            DB::commit();
            
            if($result){
                toastr()->success('Stock has been updated');
                return redirect()->back();
            }
            else{
                toastr()->error('cannot update data');
                return redirect()->back();
            }
        } catch (\Exception $ex) {
            toastr()->error('Error : '.$ex);    
            return redirect()->back();
        }
    }

    public function UpdateManualStatusOrderData(Request $request){
        $receipt_number = $request->receiptnumber;
        $order_id = $request->orderid;
        try {
            DB::beginTransaction();
            if(isset($receipt_number)){
                $result = DB::table('manual_orders')
                    ->where('manual_orders.id','=',$order_id)
                    ->update([
                        'receipt_number' => $receipt_number,
                        'status' => 'Done'
                    ]);

            }
            else{
                $result = DB::table('manual_orders')
                ->where('manual_orders.id','=',$order_id)
                ->update([
                    'status' => 'Done'
                ]);
            }
            DB::commit();

            if($result){
                toastr()->success('Stock has been updated');
                return redirect()->back();
            }
            else{
                toastr()->error('cannot update data');
                return redirect()->back();
            }
        } catch (\Exception $ex) {
            toastr()->error('Error : '.$ex);    
            return redirect()->back();
        }
    }

    public function DeleteManualOrderData(Request $request){
        try {
            DB::beginTransaction();

            $result = DB::table('manual_orders')
                ->where('id',$request->id)
                ->delete();

            DB::commit();

            if($result){
                toastr()->success('Delete Success');
                return redirect()->back();
            }
            else{
                toastr()->error('Cannot delete data');
                return redirect()->back();
            }
        } catch (\Exception $ex) {
            toastr()->error('Error : '.$ex);
            return redirect()->back();
        }
    }

    public function PrintManualOrder(Request $request){
        $order_id = $request->id;

        $result_order_manual = DB::table('manual_orders')
        ->select('manual_orders.id',
        'manual_orders.code_order',
        'manual_orders.name',
        'manual_orders.address',
        'manual_orders.contact',
        'order_sources.order_source',
        'payment_methods.payment_method',
        'shipping_methods.shipping_method',
        'manual_orders.note',
        'manual_orders.receipt_number',
        'manual_orders.status',
        'manual_orders.shipping_fee')
        ->join('order_sources','manual_orders.order_source_id','=','order_sources.id')
        ->join('shipping_methods','manual_orders.shipping_method_id','=','shipping_methods.id')
        ->join('payment_methods','manual_orders.payment_method_id','=','payment_methods.id')
        ->where('manual_orders.id','=',$order_id)
        ->get();

        $result_order_manual_item = DB::table('manual_order_items')
        ->select(
        'manual_order_items.id',
        'manual_order_items.amount',
        'manual_order_items.status',
        'manual_order_items.image',
        'phone_brands.phone_brand',
        'phone_types.phone_type',
        'case_types.case_type',
        'case_types.price',
        'list_stocks.id as stock_id')
        ->join('list_stocks','manual_order_items.list_stock_id','=','list_stocks.id')
        ->join('phone_types','list_stocks.phone_type_id','=','phone_types.id')
        ->join('phone_brands','phone_types.phone_brand_id','=','phone_brands.id')
        ->join('case_types','list_stocks.case_type_id','=','case_types.id')
        ->where('manual_order_items.manual_order_id','=',$order_id)
        ->get();

        $data = [
            'order' => $result_order_manual[0],
            'items' => $result_order_manual_item
        ];

        $pdf = PDF::loadview('superuser.printout.manualorder',$data);
        return $pdf->stream();
    }
}
