<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderSource;
use Illuminate\Support\Facades\DB;
use App\Models\ShippingMethod;
use App\Models\PaymentMethod;
use App\Models\Order;

class OrderController extends Controller
{
    public function ListOrderSource(Request $request){
        if(isset($request->searching)){
            $searching = $request->searching;
            $field = ['order_source'];

            $result = OrderSource::where(function($query) use($searching,$field){
                for ($i = 0; $i < count($field); $i++){
                    $query->orwhere($field[$i], 'like',  '%' . $searching .'%');
                } 
            })->sortable()->paginate(5);            
            return view('superuser.order.ordersource',['order_sources' => $result,'searching' => $searching]);
        }
        
        $users = OrderSource::sortable()->paginate(5);
        return view('superuser.order.ordersource',['order_sources' => $users]);
    }

    public function StoreOrderSourceData(Request $request){
        try {
            DB::beginTransaction();
            $result = DB::table('order_sources')->insert([
                'order_source' => $request->ordersource,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(), 
            ]);
            DB::commit();
            if($result){
                toastr()->success('New Order Source : '.$request->ordersource.' has been added');
                return redirect()->back();
            }
        } catch (\Exception $ex) {
            DB::rollback();
            toastr()->error('Error : '.$request->ordersource.' '.$ex);
            return redirect()->back();
        }
    }

    public function GetEditSourceOrderData(Request $request){
        $result = DB::table('order_sources')->where('id',$request->id)->first();
        $data = [
            'id' => $result->id,
            'order_source' => $result->order_source
        ];
        return response()->json($data);
    }

    public function UpdateSourceOrderData(Request $request){
        try {
            DB::beginTransaction();
            
            $result = DB::table('order_sources')
                ->where('id',$request->id)
                ->update([
                    'order_source' => $request->sourceorder,
                    'updated_at' => \Carbon\Carbon::now(), 
                ]);
                
            DB::commit();
            
            if($result){
                toastr()->success('Order Source has been updated');
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

    public function DeleteSourceOrderData(Request $request){
        try {
            DB::beginTransaction();

            $result = DB::table('order_sources')
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

    public function ListShippingMethod(Request $request){
        if(isset($request->searching)){
            $searching = $request->searching;
            $field = ['shipping_method'];

            $result = ShippingMethod::where(function($query) use($searching,$field){
                for ($i = 0; $i < count($field); $i++){
                    $query->orwhere($field[$i], 'like',  '%' . $searching .'%');
                } 
            })->sortable()->paginate(5);            
            return view('superuser.order.shippingmethod',['shipping_method' => $result,'searching' => $searching]);
        }
        
        $users = ShippingMethod::sortable()->paginate(5);
        return view('superuser.order.shippingmethod',['shipping_method' => $users]);
    }

    public function StoreShippingMethodData(Request $request){
        try {
            DB::beginTransaction();
            $result = DB::table('shipping_methods')->insert([
                'shipping_method' => $request->shippingmethod,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(), 
            ]);
            DB::commit();
            if($result){
                toastr()->success('New Shipping Method : '.$request->shippingmethod.' has been added');
                return redirect()->back();
            }
        } catch (\Exception $ex) {
            DB::rollback();
            toastr()->error('Error : '.$request->shippingmethod.' '.$ex);
            return redirect()->back();
        }
    }
    
    public function GetEditShippingMethodData(Request $request){
        $result = DB::table('shipping_methods')->where('id',$request->id)->first();
        $data = [
            'id' => $result->id,
            'shipping_method' => $result->shipping_method
        ];
        return response()->json($data);
    }

    public function UpdateShippingMethodData(Request $request){
        try {
            DB::beginTransaction();
            
            $result = DB::table('shipping_methods')
                ->where('id',$request->id)
                ->update([
                    'shipping_method' => $request->shippingmethod,
                    'updated_at' => \Carbon\Carbon::now(), 
                ]);
                
            DB::commit();
            
            if($result){
                toastr()->success('Shipping Method has been updated');
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

    public function DeleteShippingMethodData(Request $request){
        try {
            DB::beginTransaction();

            $result = DB::table('shipping_methods')
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

    public function ListPaymentMethod(Request $request){
        if(isset($request->searching)){
            $searching = $request->searching;
            $field = ['payment_method'];

            $result = PaymentMethod::where(function($query) use($searching,$field){
                for ($i = 0; $i < count($field); $i++){
                    $query->orwhere($field[$i], 'like',  '%' . $searching .'%');
                } 
            })->sortable()->paginate(5);            
            return view('superuser.order.paymentmethod',['payment_method' => $result,'searching' => $searching]);
        }
        
        $users = PaymentMethod::sortable()->paginate(5);
        return view('superuser.order.paymentmethod',['payment_method' => $users]);
    }

    public function StorePaymentMethodData(Request $request){
        try {
            DB::beginTransaction();
            $result = DB::table('payment_methods')->insert([
                'payment_method' => $request->paymentmethod,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(), 
            ]);
            DB::commit();
            if($result){
                toastr()->success('New Payment Method : '.$request->shippingmethod.' has been added');
                return redirect()->back();
            }
        } catch (\Exception $ex) {
            DB::rollback();
            toastr()->error('Error : '.$request->shippingmethod.' '.$ex);
            return redirect()->back();
        }
    }

    public function GetEditPaymentMethodData(Request $request){
        $result = DB::table('payment_methods')->where('id',$request->id)->first();
        $data = [
            'id' => $result->id,
            'payment_method' => $result->payment_method
        ];
        return response()->json($data);
    }

    public function UpdatePaymentMethodData(Request $request){
        try {
            DB::beginTransaction();
            
            $result = DB::table('payment_methods')
                ->where('id',$request->id)
                ->update([
                    'payment_method' => $request->paymentmethod,
                    'updated_at' => \Carbon\Carbon::now(), 
                ]);
                
            DB::commit();
            
            if($result){
                toastr()->success('Payment Method has been updated');
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

    public function DeletePaymentMethodData(Request $request){
        try {
            DB::beginTransaction();

            $result = DB::table('payment_methods')
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

    public function ListOrder(Request $request){
        $order_source = DB::table('order_sources')->select('id','order_source')->get();
        $payment_method = DB::table('payment_methods')->select('id','payment_method')->get();
        $shipping_method = DB::table('shipping_methods')->select('id','shipping_method')->get();

        $searching = $request->searching;
        $start = $request->start;
        $end = $request->end;

        $field = ['code_order','receipt_number','name','address','order_source','payment_method','shipping_method'];

        if(isset($searching) && !isset($start,$end)){
            $result = Order::select('orders.id',
            'orders.code_order',
            'orders.receipt_number',
            'orders.name',
            'orders.address',
            'order_sources.order_source',
            'payment_methods.payment_method',
            'shipping_methods.shipping_method',
            'orders.date_create',
            DB::raw('DATE_FORMAT(orders.created_at, "%H:%i:%s") as time'))
            ->join('order_sources','orders.order_source_id','=','order_sources.id')
            ->join('shipping_methods','orders.shipping_method_id','=','shipping_methods.id')
            ->join('payment_methods','orders.payment_method_id','=','payment_methods.id')
            ->where(function($query) use($searching,$field,$start,$end){
                for($i = 0; $i < count($field); $i++){
                    $query->orWhere($field[$i], 'like',  '%' . $searching .'%');
                }
            })
            ->orderBy('time','desc')
            ->paginate(10);

            return view('superuser.order.order',[
                'order' => $result,
                'searching' => $searching,
                'order_source' => $order_source,
                'payment_method' =>$payment_method,
                'shipping_method' => $shipping_method
            ]);
        } else if(isset($request->searching) || isset($request->start) ){
            $result = Order::select('orders.id',
            'orders.code_order',
            'orders.receipt_number',
            'orders.name',
            'orders.address',
            'order_sources.order_source',
            'payment_methods.payment_method',
            'shipping_methods.shipping_method',
            'orders.date_create',
            DB::raw('DATE_FORMAT(orders.created_at, "%H:%i:%s") as time'))
            ->join('order_sources','orders.order_source_id','=','order_sources.id')
            ->join('shipping_methods','orders.shipping_method_id','=','shipping_methods.id')
            ->join('payment_methods','orders.payment_method_id','=','payment_methods.id')
            ->where(function($query) use($searching,$field,$start,$end){
                for($i = 0; $i < count($field); $i++){
                    $query->orWhere($field[$i], 'like',  '%' . $searching .'%');
                }
            })
            ->whereBetween('date_create',[$start,$end])
            ->orderBy('time','desc')
            ->paginate(10);

            return view('superuser.order.order',[
                'order' => $result,
                'searching' => $searching,
                'start' => $start,
                'end' => $end,
                'order_source' => $order_source,
                'payment_method' =>$payment_method,
                'shipping_method' => $shipping_method
            ]);
        }

        $result = Order::select('orders.id',
            'orders.code_order',
            'orders.receipt_number',
            'orders.name',
            'orders.address',
            'order_sources.order_source',
            'payment_methods.payment_method',
            'shipping_methods.shipping_method',
            DB::raw('DATE_FORMAT(orders.created_at, "%H:%i:%s") as time'))
            ->join('order_sources','orders.order_source_id','=','order_sources.id')
            ->join('shipping_methods','orders.shipping_method_id','=','shipping_methods.id')
            ->join('payment_methods','orders.payment_method_id','=','payment_methods.id')
            ->orderBy('time','desc')
            ->sortable()
            ->paginate(10);

        return view('superuser.order.order',[
            'order' => $result,
            'order_source' => $order_source,
            'payment_method' =>$payment_method,
            'shipping_method' => $shipping_method
            ]);
    }

    public function StoreOrderData(Request $request){
        try {
            DB::beginTransaction();
            $code_order = $request->user.'-'.date('Y/m/d-H:i:s');
            $result = DB::table('orders')->insert([
                'code_order'         => $code_order,
                'receipt_number'     => $request->receiptnumber,
                'name'               => $request->name,
                'address'            => $request->address,
                'order_source_id'    => $request->ordersource,
                'payment_method_id'  => $request->paymentmethod,
                'shipping_method_id' => $request->shippingmethod,
                'user_id'            => $request->userid,
                'date_create'        => date('Y/m/d'),
                'created_at'         => \Carbon\Carbon::now(), 
                'updated_at'         => \Carbon\Carbon::now(), 
            ]);

            DB::commit();

            if($result){
                toastr()->success('New Order : '.$request->code_order.' has been added');
                return redirect()->back();
            }

        } catch (\Exception $ex) {
            DB::rollback();
            toastr()->error('Error : '.$request->code_order.' '.$ex);
            return redirect()->back();
        }
    }

    public function GetOrderData(Request $request){
        $result = Order::select('orders.id',
            'orders.receipt_number',
            'orders.name',
            'orders.address',
            'orders.order_source_id',
            'orders.payment_method_id',
            'orders.shipping_method_id')
            ->where('orders.id','=',$request->id)
            ->get();

        if($result){
            return response()->json($result[0]);
        }
    }

    public function UpdateOrderData(Request $request){
        try {
            DB::beginTransaction();
            $result = DB::table('orders')
                ->where('id',$request->id)
                ->update([
                    'receipt_number'     => $request->receiptnumber,
                    'name'               => $request->name,            
                    'address'            => $request->address,
                    'order_source_id'    => $request->ordersource,
                    'payment_method_id'  => $request->paymentmethod,
                    'shipping_method_id' => $request->shippingmethod,
                    'updated_at'         => \Carbon\Carbon::now(), 
                ]);
            DB::commit();

            if($result){
                toastr()->success('Orders has been updated');
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

    public function DeleteOrderData(Request $request){
        try {
            DB::beginTransaction();

            $result = DB::table('orders')
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
}
