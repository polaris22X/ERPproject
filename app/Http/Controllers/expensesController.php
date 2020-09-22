<?php

namespace App\Http\Controllers;
use App\organization;
use App\product;
use App\partner;
use App\invoice;
use App\receipt;
use Carbon\Carbon;
use Illuminate\Http\Request;

class expensesController extends Controller
{
    public function index(Request $request){
        $id = $request->session()->get('organization_id');
        $organization = new organization();
        $organizations = $organization->getorganization($id);
        return view('expenses/menu')->with(compact('organizations'));
    }
    public function insert(Request $request){
        $userlevel_id = $request->session()->get('userlevel_id');
        if($userlevel_id != 1){
            return redirect()->action('organizationController@index');
        }
        $id = $request->session()->get('organization_id');
        $organization = new organization();
        $organizations = $organization->getorganization($id);
        $product = new product();
        $products = $product->select($id);
        $partner = new partner();
        $partners = $partner->select($id);
        return view('expenses/addexpenses')->with(compact(['organizations','products','partners']));
    }
    public function list(Request $request){
        $id = $request->session()->get('organization_id');
        $organization = new organization();
        $organizations = $organization->getorganization($id);
        return view('expenses/list')->with(compact(['organizations']));
    }
}
