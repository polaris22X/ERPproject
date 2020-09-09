<?php

namespace App\Http\Controllers;
use App\product;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function store(Request $request){
        request()->validate([
            'product_name' => 'required',
            'product_description' => 'required'
        ]);
        $product_name = request()->input('product_name');
        $product_description = request()->input('product_description');
        $organization_id = $request->session()->get('organization_id');
        $product = new product();
        $data = $product->selectlastid($organization_id);
        if($data){
            foreach($data as $id){
            $lastid = $id->product_id;
            }
        $lastid = $lastid + 1;
        }
        else{
            $lastid = 1; 
        }
        $product->insert($lastid,$organization_id,$product_name,$product_description);
        $msg = $lastid;
        
        return response()->json(array('msg'=> $msg), 200);
        /*if(request()->input('page') == "insert"){
            return redirect()->action('incomeController@insert');
        }
        if(request()->input('page') == "update"){
            $idincome = request()->input('income_id');
            return redirect('income/update/'.$idincome);
        }*/
    }
}
