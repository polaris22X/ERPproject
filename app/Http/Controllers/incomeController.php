<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\organization;
use App\product;
use App\partner;
use App\income;
class incomeController extends Controller
{
    public function index(Request $reqeust){
        $id = $reqeust->session()->get('organization_id');
        $organization = new organization();
        $data = $organization->getorganization($id);
        return view('income/incomemenu')->with('organizations',$data);
    }
    public function insert(Request $reqeust){
        $id = $reqeust->session()->get('organization_id');
        $organization = new organization();
        $organizations = $organization->getorganization($id);
        $product = new product();
        $products = $product->select($id);
        $partner = new partner();
        $partners = $partner->select($id);
        return view('income/addincome')->with(compact(['organizations','products','partners']));
    }
    public function store(Request $reqeust){
        $data = request()->validate([
            'partner_id' => 'required',
            'partner_address' => 'required',
            'product_id' => 'required',
            'product_price' => 'required',
            'product_amount' => 'required'
        ]);
        
        $partner_id = request()->input('partner_id');
        $partner_address = request()->input('partner_address');
        $product_id = request()->input('product_id');
        $product_price = request()->input('product_price');
        $product_amount = request()->input('product_amount');

        $organization_id = $reqeust->session()->get('organization_id');
        $organization = new organization();
        $organizations = $organization->getorganization($organization_id);
        $income = new income();
        $data = $income->selectlastid($organization_id);
        
        if($data){
            foreach($data as $id){
            $lastid = $id->income_id;
            }
        $lastid = $lastid + 1;
        }
        else{
            $lastid = 1; 
        }
        $i = 0;
        while($i < count($product_id)){
           $income = new income();
           $income->insert($lastid,$organization_id,$product_id[$i],$product_price[$i],$product_amount[$i],$partner_id,$partner_address);
           $i++;
        }
        return view('income/incomemenu')->with('organizations',$organizations);
    }
}
