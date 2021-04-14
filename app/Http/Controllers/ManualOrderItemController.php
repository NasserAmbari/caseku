<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManualOrderItem;
use Illuminate\Support\Facades\DB;
use Image;

class ManualOrderItemController extends Controller
{
    private function CheckItemCount($order){
        return $isThereAnItem = DB::table('manual_order_items')
                ->select('manual_order_items.manual_order_id')
                ->where('manual_order_items.manual_order_id','=',$order)
                ->count();
    }

    private function ChangeStatusItem($manual_order_item_id,$status){
        try {
            DB::beginTransaction();

            $result = DB::table('manual_order_items')
                ->where('manual_order_items.id','=',$manual_order_item_id)
                ->update([
                    'status'     => $status,
                    'updated_at' => \Carbon\Carbon::now()
                ]);

            DB::commit();

            return $result;

        } catch (\Exception $ex) {
            toastr()->error('Error : '.json_encode($ex));
            return redirect()->back();
        }
        
    }

    private function ChangeStatusOrder($order_id,$status){
        try {
            DB::beginTransaction();

            DB::table('manual_orders')
            ->where('id',$order_id)
            ->update([
                'status'     => $status,
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            DB::commit();
        } catch (\Exception $ex) {
            toastr()->error('Error : '.json_encode($ex));
            return redirect()->back();
        }
    }

    public function ListOrderManualItem(Request $request){
        $code_order = DB::table('manual_orders')->select('code_order')->where('manual_orders.id','=',$request->id)->get();
        $phone_brands = DB::table('phone_brands')->select('id','phone_brand')->get();
        $case_type = DB::table('case_types')->select('id','case_type')->get();
        $status_order = DB::table('manual_orders')->select('status')->where('manual_orders.id','=',$request->id)->get();

        $str = str_replace(["\\","\""], '', json_encode($code_order[0]->code_order));
        $searching = $request->searching;

        $field = ['amount','phone_brand','phone_type','case_type'];

        if(isset($searching)){
            $result = ManualOrderItem::select(
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
            ->where('manual_order_items.manual_order_id','=',$request->id)
            ->where(function($query) use($searching,$field,$start,$end){
                for($i = 0; $i < count($field); $i++){
                    $query->orWhere($field[$i], 'like',  '%' . $searching .'%');
                }
            })
            ->orderBy('manual_order_items.created_at','desc')
            ->paginate(10);

            return view('superuser.order.ordermanualitem',[
                'order' => $result,
                'searching' => $searching,
                'order_id' => $request->id,
                'code'  => $str,
                'phone_brand' => $phone_brands,
                'case_type' => $case_type,
                'status' => $status_order[0]->status
            ]);
        }

        $result = ManualOrderItem::select(
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
            ->where('manual_order_items.manual_order_id','=',$request->id)
            ->orderBy('manual_order_items.created_at','desc')
            ->paginate(10);

        $data = [
            'order' => $result,
            'code'  => $str,
            'order_id' => $request->id,
            'phone_brand' => $phone_brands,
            'case_type' => $case_type,
            'status' => $status_order[0]->status
        ];

        return view('superuser.order.ordermanualitem',$data);
    }

    public function CheckItem(Request $request){
        $result = DB::table('list_stocks')
                ->where('phone_type_id',$request->phone_type)
                ->where('case_type_id',$request->case_type)
                ->get();
        return response()->json($result);
    }

    public function StoreManualOrderItemData(Request $request){
        $result;

        try {
            if($request->status == "Pre-Order"){

                /**
                 * 
                 * If There Is No Data Stock 
                 */
                if($request->stockid == null){
                    DB::beginTransaction();

                    $list_stock_id = DB::table('list_stocks')
                        ->insertGetId([
                            'phone_type_id'   => $request->typephone,
                            'case_type_id'    => $request->casetype,
                            'stock'           => 0,
                            'created_at'      => \Carbon\Carbon::now(), 
                            'updated_at'      => \Carbon\Carbon::now(), 
                        ]);
                        
                    /**
                     * 
                     * If There Is No Data Stock And It Has an Image
                     */
                    if($request->hasFile('image')){
                        
                        $image       = $request->file('image');
                        
                        $file_name   = $request->orderid.'-'.date("Y-m-d").'.'.$request->image->getClientOriginalExtension();
                        
                        $image_resize = Image::make($image->getRealPath());              
                        $image_resize->resize(100, 100,function($constraint) {
                            $constraint->aspectRatio();
                        });
                        
                        $image_resize->save(public_path('images/orderitems/' .$file_name));

                        $result = DB::table('manual_order_items')
                        ->insert([
                            'manual_order_id' => $request->orderid,
                            'list_stock_id'   => $list_stock_id,
                            'status'          => $request->status,
                            'amount'          => $request->amount,
                            'image'           => $file_name,
                            'created_at'      => \Carbon\Carbon::now(), 
                            'updated_at'      => \Carbon\Carbon::now(),
                        ]);
                    }

                    /**
                     * 
                     * If There Is No Data Stock And It Doesnt Have Image
                     */
                    else {
                        $result = DB::table('manual_order_items')
                        ->insert([
                            'manual_order_id' => $request->orderid,
                            'list_stock_id'   => $list_stock_id,
                            'status'          => $request->status,
                            'amount'          => $request->amount,
                            'image'           => 'NoImage.webp',
                            'created_at'      => \Carbon\Carbon::now(), 
                            'updated_at'      => \Carbon\Carbon::now(),
                        ]);
                        
                    }
                    DB::commit();

                /**
                 * 
                 * If There is A Data Stock
                 */
                } else {
                    DB::beginTransaction();
                    
                    /**
                     * 
                     * If There is A Data Stock But 0 Stock And It Has an Image
                     */
                    if($request->hasFile('image')){
                        $image       = $request->file('image');
                        $file_name   = $request->orderid.'-'.\Carbon\Carbon::now();
                        $image_resize = Image::make($image->getRealPath());              
                        $image_resize->resize(100, 100,function($constraint) {
                            $constraint->aspectRatio();
                        });
                        $image_resize->save(public_path('images/orderitems/' .$file_name));
                        
                        
                        $result = DB::table('manual_order_items')
                        ->insert([
                            'manual_order_id' => $request->orderid,
                            'list_stock_id'   => $request->stockid,
                            'status'          => $request->status,
                            'amount'          => $request->amount,
                            'image'           => $file_name,
                            'created_at'      => \Carbon\Carbon::now(), 
                            'updated_at'      => \Carbon\Carbon::now(),
                        ]);
                    }

                    /**
                     * 
                     * If There is A Data But 0 Stock And It Does'nt Have Image
                     */
                    else{
                        $result = DB::table('manual_order_items')
                        ->insert([
                            'manual_order_id' => $request->orderid,
                            'list_stock_id'   => $request->stockid,
                            'status'          => $request->status,
                            'amount'          => $request->amount,
                            'image'           => 'NoImage.webp',
                            'created_at'      => \Carbon\Carbon::now(), 
                            'updated_at'      => \Carbon\Carbon::now(),
                        ]);
                    }
                    DB::commit();
                }
            }
            else if($request->status == "Ready To Print"){
                $result_old_stock = DB::table('list_stocks')
                ->select('list_stocks.stock')
                ->where('id',$request->stockid)
                ->get();

                $old_stock = $result_old_stock[0]->stock;
                $new_stock = $old_stock - $request->amount;

                DB::beginTransaction();

                if($request->hasFile('image')){
                    
                    $image       = $request->file('image');
                    $file_name   = $request->orderid.'-'.\Carbon\Carbon::now();

                    $image_resize = Image::make($image->getRealPath());              
                    $image_resize->resize(100, 100,function($constraint) {
                        $constraint->aspectRatio();
                    });
                    $image_resize->save(public_path('images/orderitems/' .$file_name));

                    $result = DB::table('manual_order_items')
                    ->insert([
                        'manual_order_id' => $request->orderid,
                        'list_stock_id'   => $request->stockid,
                        'status'          => $request->status,
                        'amount'          => $request->amount,
                        'image'           => $file_name,
                        'created_at'      => \Carbon\Carbon::now(), 
                        'updated_at'      => \Carbon\Carbon::now(),
                    ]);
                }
                else{
                    $result = DB::table('manual_order_items')
                    ->insert([
                        'manual_order_id' => $request->orderid,
                        'list_stock_id'   => $request->stockid,
                        'status'          => $request->status,
                        'amount'          => $request->amount,
                        'image'           => 'NoImage.webp',
                        'created_at'      => \Carbon\Carbon::now(), 
                        'updated_at'      => \Carbon\Carbon::now(),
                    ]);
                }


                $result_list_stock = DB::table('list_stocks')
                    ->where('id',$request->stockid)
                    ->update([
                        'stock' => $new_stock
                    ]);

                $result = $result_list_stock;

                DB::commit();
            }

            /**
             * 
             * Update Status Order Item When There is item > 0
             */

            $isThereAnItem = $this->CheckItemCount($request->orderid);

            if($isThereAnItem > 0){
                $this->ChangeStatusOrder($request->orderid,'On Progress');
            }

            if($result){
                toastr()->success('New Manual Order : '.' has been added');
                return redirect()->back();
            }
            dd($result);
        } catch (\Exception $ex) {
            toastr()->error('Error : '.json_encode($ex));
            return redirect()->back();
        }
    }

    public function GetStatusItem(Request $request){
        $result = DB::table('manual_order_items')
            ->select(
                'manual_order_items.id',
                'manual_order_items.status',
                'manual_order_items.amount'
                )
            ->where('id',$request->id)
            ->get();

        return response()->json($result[0]);
    }

    public function UpdateStatusDataItem(Request $request){

        $result_update;
        $id_manual_item = $request->id;
        $order_id = $request->orderid;

        $result = DB::table('manual_order_items')
            ->select(
                'manual_order_items.status',
                'manual_order_items.list_stock_id')
            ->where('id','=',$id_manual_item)
            ->get();

        if($result[0]->status == "Pre-Order"){
            $list_stock_id = $result[0]->list_stock_id;

            $result_get_liststock = DB::table('list_stocks')
                ->select('list_stocks.stock')
                ->where('id','=',$list_stock_id)
                ->get();

            $stock = $result_get_liststock[0]->stock;
            $amount = $request->amount;

            if($amount > $stock){
                toastr()->error('The items are lacking or the items are empty, Restock Now!');
                return redirect()->back();
            } else {
                try {
                    DB::beginTransaction();
                    $result_update_stock = DB::table('list_stocks')
                        ->where('list_stocks.id','=',$list_stock_id)
                        ->decrement('stock',$amount);
                    $result_update_status = $this->ChangeStatusItem($id_manual_item,'Ready To Print');
                    DB::commit();

                    if($result_update_status){
                        toastr()->success('Item Ready To Print');
                        return redirect()->back();
                    }
                } catch (\Exception $ex) {
                    toastr()->error('Error : '.json_encode($ex));
                    return redirect()->back();
                }
            }
            
        }
        else if($result[0]->status == "Ready To Print") {
            $id_manual_item = $request->id;
            $result_update_status = $this->ChangeStatusItem($id_manual_item, 'Ready To Ship');

            $count_order_item = DB::table('manual_order_items')
                ->where('manual_order_items.manual_order_id','=',$order_id)
                ->count();

            $count_order_status_ready_ship = DB::table('manual_order_items')
                ->where('manual_order_items.manual_order_id','=',$order_id)
                ->where('manual_order_items.status','=',"Ready To Ship")
                ->count();

            if($count_order_item == $count_order_status_ready_ship){
                $this->ChangeStatusOrder($order_id,'Ready To Ship');
            }

            toastr()->success('Ready To Ship');
            return redirect()->back();
        }
    }

    public function DeleteManualOrderItemData(Request $request){
        $order_id = $request->orderid;
        $list_stock_id = $request->stockid;
        $amount = $request->amount;
        
        

        try {
            if($request->status == 'Ready To Print'){

                DB::beginTransaction();

                DB::table('list_stocks')
                    ->where('list_stocks.id','=',$request->stockid)
                    ->increment('stock',$request->amount);
                    
                $result = DB::table('manual_order_items')
                    ->where('id',$request->id)
                    ->delete();

                DB::commit();
            } else {
                DB::beginTransaction();

                $result = DB::table('manual_order_items')
                    ->where('id',$request->id)
                    ->delete();

                DB::commit();
            }


            $count_order_status_ready_ship = DB::table('manual_order_items')
            ->where('manual_order_items.manual_order_id','=',$order_id)
            ->where('manual_order_items.status','=',"Ready To Ship")
            ->count();
                
            $is_there_an_item = $this->CheckItemCount($order_id);

            
            if($is_there_an_item <= 0){
                $this->ChangeStatusOrder($order_id,'No Items Yet');
            } else if ($is_there_an_item == $count_order_status_ready_ship){
                $this->ChangeStatusOrder($order_id,'Ready To Ship');
            }

            if($result){
                toastr()->success('Deleted');
                return redirect()->back();
            }

        } catch (\Exception $ex) {
            toastr()->error('Error : '.json_encode($ex));
            return redirect()->back();
        }
    }

}
