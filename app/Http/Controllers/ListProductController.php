<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CaseType;
use App\Models\PhoneBrand;
use App\Models\PhoneType;
use App\Models\ListStock;

class ListProductController extends Controller
{
    /**
     * 
     * List Case
     */

    public function ListCasePage(Request $request){
        if(isset($request->searching)){
            $searching = $request->searching;
            $field = ['case_type','price'];

            $result = CaseType::where(function($query) use($searching,$field){
                for ($i = 0; $i < count($field); $i++){
                    $query->orwhere($field[$i], 'like',  '%' . $searching .'%');
                } 
            })->sortable()->paginate(5);            
            return view('superuser.product.casetype',['case_types' => $result,'searching' => $searching]);
        }
        
        $case_type = CaseType::sortable()->paginate(5);
        return view('superuser.product.casetype',['case_types' => $case_type]);
    }

    public function StoreCaseData(Request $request){
        try {
            DB::beginTransaction();
            $result = DB::table('case_types')->insert([
                'case_type' => $request->casetype,
                'price' => $request->price,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(), 
            ]);
            DB::commit();
            if($result){
                toastr()->success('Case : '.$request->casetype.'has been added');
                return redirect()->back();
            }
        } catch (\Exception $ex) {
            DB::rollback();
            $data=[
                'status'=>500,
                'message'=>'Cannot Store Data',
                'case_type'=>$ex,
            ];
            toastr()->success('Case : '.$request->casetype.' '.$ex);
            return redirect()->back();
        }
    }

    public function GetEditCaseData(Request $request){
        $case_type = DB::table('case_types')->where('id',$request->id)->first();
        $data = [
            'id' => $case_type->id,
            'case_type' => $case_type->case_type,
            'price' => $case_type->price
        ];
        return response()->json($data);
    }
    
    public function UpdateListCaseData(Request $request){
        try {
            
            DB::beginTransaction();
            
            $result = DB::table('case_types')
                ->where('id',$request->id)
                ->update([
                    'case_type' => $request->casetype,
                    'price' => $request->price,
                    'updated_at' => \Carbon\Carbon::now(), 
                ]);

            DB::commit();

            if($result){
                toastr()->success('Case : '.$request->casetype.' has been updated');
                return redirect()->back();
            }
            else{
                toastr()->error('cannot update data');
                return redirect()->back();
            }
        } catch (\Exception $ex) {
            toastr()->error('Error : '.$ex);
            return redirect()->route('listCase');
        }
    }

    public function DeleteCaseData(Request $request){
        try {
            DB::beginTransaction();

            $result = DB::table('case_types')
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
            return redirect()->route('listCase');
        }
    }

    /**
     * 
     * Phone Brand
     */

    public function ListPhonePage(Request $request  ){
        if(isset($request->searching)){
            $searching = $request->searching;
            $field = ['phone_brand'];

            $result = PhoneBrand::where(function($query) use($searching,$field){
                for ($i = 0; $i < count($field); $i++){
                    $query->orwhere($field[$i], 'like',  '%' . $searching .'%');
                } 
            })->sortable()->paginate(5);            
            return view('superuser.product.listphonebrand',['phone_brands' => $result,'searching' => $searching]);
        }
        $phone_brands = PhoneBrand::sortable()->paginate(5);
        return view('superuser.product.listphonebrand',[
            'phone_brands' => $phone_brands,
            ]);
    }

    public function StoreBrandPhoneData(Request $request){
        try {   
            DB::beginTransaction();

            $result = DB::table('phone_brands')->insert([
                'phone_brand' => $request->brandphone,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(), 
            ]);

            DB::commit();
            
            if($result){
                toastr()->success('Brands Phone : '.$request->brandphone);
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            $data=[
                'status'=>500,
                'message'=>'Cannot Store Data',
                'case_type'=>$ex,
            ];
            toastr()->success('Brands Phone : '.$request->brandphone.' '.$ex);
            return redirect()->back();
        }
    }

    public function GetEditPhoneBrandData(Request $request){
        $result = DB::table('phone_brands')->where('id',$request->id)->first();
        $data = [
            'id' => $result->id,
            'phone_brand' => $result->phone_brand,
        ];
        return response()->json($data);
    }

    public function UpdatePhoneBrandData(Request $request){
        try {
            DB::beginTransaction();
            
            $result = DB::table('phone_brands')
                ->where('id',$request->id)
                ->update([
                    'phone_brand' => $request->phonebrand,
                    'updated_at' => \Carbon\Carbon::now(), 
                ]);
                
            DB::commit();
            
            if($result){
                toastr()->success('Case : '.$request->casetype.' has been updated');
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

    public function DeletePhoneBrandData(Request $request){
        try {
            DB::beginTransaction();

            $result = DB::table('phone_brands')
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
            return redirect()->route('listCase');
        }
    }

    /**
     * 
     * Phone Type
     */
    
    public function ListPhoneTypePage(Request $request){
        $phone_brands = DB::table('phone_brands')->select('id','phone_brand')->get();
        if(isset($request->searching)){
            $searching = $request->searching;
            $field = ['phone_type','phone_brand'];
            
            $result = PhoneType::select( 'phone_types.id',
            'phone_types.phone_type as phone_type',
            'phone_brands.phone_brand as phone_brand')
                ->join('phone_brands','phone_types.phone_brand_id','=','phone_brands.id')
                ->where(function($query) use($searching,$field){
                    for ($i = 0; $i < count($field); $i++){
                        $query->orwhere($field[$i], 'like',  '%' . $searching .'%');
                    } 
                })
                ->sortable()
                ->paginate(5);

            return view('superuser.product.listphonetype',[
                'phone_types' => $result,
                'phone_brand' => $phone_brands,
                'searching' => $searching,
                ]);
        }
        
        $result = PhoneType::select('phone_types.id','phone_types.phone_type','phone_brands.phone_brand')
                ->join('phone_brands','phone_types.phone_brand_id','=','phone_brands.id')
                ->sortable()
                ->paginate(5);

        return view('superuser.product.listphonetype',[
            'phone_types' => $result,
            'phone_brand' => $phone_brands
            ]);
    }

    public function StorePhoneTypeData(Request $request){
        try {
            $phone_brand = DB::table('phone_brands')->where('id','=',$request->brandid)->pluck('phone_brand');
            
            DB::beginTransaction();

            $result = DB::table('phone_types')->insert([
                'phone_type' => $request->typephone,
                'phone_brand_id' => $request->brandid,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(), 
            ]);

            DB::commit();
            
            if($result){
                toastr()->success('Type: '.$request->typephone." Has Been Added");
                return redirect()->back();
            } else {
                toastr()->error('There is error');
                return redirect()->back();
            }
        } catch (\Exception $ex) {
            DB::rollback();
            $data=[
                'status'=>500,
                'message'=>'Cannot Store Data',
                'error'=>$ex,
            ];
            toastr()->success('Brands Phone : '.$request->brandphone.' '.$ex);
            return redirect()->back();
        }
    }

    public function GetEditPhoneTypeData(Request $request){
        $result = DB::table('phone_types')->where('id',$request->id)->first();
        $data = [
            'id' => $result->id,
            'phone_type' => $result->phone_type,
            'phone_brand_id' => $result->phone_brand_id,
        ];
        return response()->json($data);
    }

    public function UpdateListPhoneTypeData(Request $request){
        try {
            DB::beginTransaction();
            
            $result = DB::table('phone_types')
                ->where('id',$request->id)
                ->update([
                    'phone_type' => $request->phonetype,
                    'phone_brand_id' => $request->brandid,
                    'updated_at' => \Carbon\Carbon::now(), 
                ]);
                
            DB::commit();
            
            if($result){
                toastr()->success('Type : '.$request->phonetype.' has been updated');
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

    public function DeletePhoneTypeData(Request $request){
        try {
            DB::beginTransaction();

            $result = DB::table('phone_types')
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

    /**
     * 
     * Stocks Product
     */

    public function ListStockProductPage(Request $request){
        $phone_brands = DB::table('phone_brands')->select('id','phone_brand')->get();
        $case_type = DB::table('case_types')->select('id','case_type')->get();

        if(isset($request->searching)){
            $searching = $request->searching;
            $field = ['phone_type','phone_brand','case_type','stock'];

            $result = ListStock::select('list_stocks.id as id',
            "phone_types.phone_type",
            'phone_brands.phone_brand',
            'case_types.case_type',
            'list_stocks.stock as stock')
            ->join('case_types','list_stocks.case_type_id','=','case_types.id')
            ->join('phone_types','list_stocks.phone_type_id','=','phone_types.id')
            ->leftJoin('phone_brands','phone_types.phone_brand_id','=','phone_brands.id')
            ->where(function($query) use($searching,$field){
                for($i = 0; $i < count($field); $i++){
                    $query->orwhere($field[$i], 'like',  '%' . $searching .'%');
                }
            })
            ->sortable()
            ->paginate(5);

            return view('superuser.product.liststock',[
                'list_stocks' => $result,
                'searching' => $searching,
                'phone_brand' => $phone_brands,
                'case_type' => $case_type
            ]);
        }

        $result = ListStock::select('list_stocks.id',
            "phone_types.phone_type",
            'phone_brands.phone_brand',
            'case_types.case_type',
            'list_stocks.stock')
            ->join('case_types','list_stocks.case_type_id','=','case_types.id')
            ->join('phone_types','list_stocks.phone_type_id','=','phone_types.id')
            ->leftJoin('phone_brands','phone_types.phone_brand_id','=','phone_brands.id')
            ->sortable()
            ->paginate(5);

        return view('superuser.product.liststock',[
            'list_stocks' => $result,
            'phone_brand' => $phone_brands,
            'case_type' => $case_type 
            ]);
    }

    public function StoreStockProductData(Request $request){
        try {
            DB::beginTransaction();
            $result = DB::table('list_stocks')->insert([
                'phone_type_id' => $request->typephone,
                'case_type_id' => $request->casetype,
                'stock' => $request->stock,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(), 
            ]);
            DB::commit();

            if($result){
                toastr()->success('New Stock has been added');
                return redirect()->back();
            } else {
                toastr()->error('There is error in here');
                return redirect()->back();
            }
        } catch (\Exception $ex) {
            DB::rollback();
            $data=[
                'status'=>500,
                'message'=>'Cannot Store Data',
                'error'=>$ex,
            ];
            toastr()->error('Error : '.$ex);
            return redirect()->back();
        }
    }

    public function GetTypePhone(Request $request){
        $result = DB::table('phone_types')->where('phone_brand_id',$request->id)->get();
        return response()->json($result);
    }

    public function GetEditStockProductData(Request $request){
        $result = ListStock::select('list_stocks.id',
            'list_stocks.phone_type_id',
            'list_stocks.case_type_id',
            'phone_brands.id as idbrand',
            'list_stocks.stock')
            ->join('phone_types','list_stocks.phone_type_id','=','phone_types.id')
            ->leftJoin('phone_brands','phone_types.phone_brand_id','=','phone_brands.id')
            ->where('list_stocks.id',$request->id)
            ->get();
        if($result){
            return response()->json($result[0]);
        }
    }

    public function UpdateStockProductData(Request $request){
        try {
            DB::beginTransaction();
            
            $result = DB::table('list_stocks')
                ->where('id',$request->id)
                ->update([
                    'phone_type_id' => $request->updatephonetype,
                    'case_type_id' => $request->updatecasetype,
                    'stock' => $request->stock,
                    'updated_at' => \Carbon\Carbon::now(), 
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

    public function DeleteStockProductData(Request $request){
        try {
            DB::beginTransaction();

            $result = DB::table('list_stocks')
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
