<?php

namespace App\Http\Controllers;
use App\organization;
use App\product;
use App\partner;
use App\expenses;
use App\purchaseorder;
use App\invoice;
use App\receipt;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;

class purchaseorderController extends Controller
{
    public function index(Request $request){
        $id = $request->session()->get('organization_id');
        $organization = new organization();
        $purchaseorder = new purchaseorder();
        $readytopurchaseorder = $purchaseorder->getreadytopurchaseorder($id);
        $readytoaccept = $purchaseorder->getreadytoaccept($id);
        $purchaseorders = $purchaseorder->selectPurchaseorder($id);
        $organizations = $organization->getorganization($id);
        return view('expenses/purchaseorder/list')->with(compact(['organizations','readytopurchaseorder','purchaseorders','readytoaccept']));
    }

    public function acceptlist(Request $request){
        $id = $request->session()->get('organization_id');
        $organization = new organization();
        $purchaseorder = new purchaseorder();
        $organizations = $organization->getorganization($id);
        $purchaseorders = $purchaseorder->listtoaccept($id);
        return view('expenses/purchaseorder/accept')->with(compact(['organizations','purchaseorders']));
    }

    public function acceptprocess(Request $request,$idexpenses){
        $id = $request->session()->get('organization_id');
        $expenses = new expenses();
        $purchaseorder = new purchaseorder();
        $product = new product();
        $unixTimeStamp = Carbon::now()->toDateTimeString();
        $expenseslist = $expenses->getdata($id,$idexpenses);
        foreach ($expenseslist as $listproduct) {
           $product->updateaddstock($id,$listproduct->product_id,$listproduct->amount);
        }
        $purchaseorders = $purchaseorder->PurchaseorderAccept($id,$idexpenses,$unixTimeStamp);
        return redirect()->action('purchaseorderController@acceptlist');
    }
       

    public function create(Request $request){
        $id = $request->session()->get('organization_id');
        $organization = new organization();
        $purchaseorder = new purchaseorder();
        $organizations = $organization->getorganization($id);
        $expenseslist = $purchaseorder->selectReadyToPurchaseorder($id);
        return view('expenses/purchaseorder/create')->with(compact(['organizations','expenseslist']));
    }
    public function createPurchaseorder(Request $request, $expenses_id){
        $organization_id = $request->session()->get('organization_id');
        $purchaseorder = new purchaseorder();
        $data = $purchaseorder->selectlastid($organization_id);
        if($data){
            foreach($data as $id){
            $lastid = $id->purchaseorder_id;
            }
        $lastid = $lastid + 1;
        }
        else{
            $lastid = 1; 
        }
        $PO = str_pad($lastid, 8, 0, STR_PAD_LEFT);
        $POID = "PO-" . $PO;
        $purchaseorder->createPurchaseorder($organization_id,$expenses_id,$lastid,$POID);
        return redirect()->action('purchaseorderController@index');
    }

    public function show(Request $request, $purchaseorder_id){
        $id = $request->session()->get('organization_id');
        $organization = new organization();
        $organizations = $organization->getorganization($id);
        $purchaseorder = new purchaseorder();
        $purchaseorders = $purchaseorder->selectPurchaseorderAll($id,$purchaseorder_id);
        $details = $purchaseorder->selectPurchaseorderRow($id,$purchaseorder_id);
        $sums = $purchaseorder->selectSum($id,$purchaseorder_id);
        return view('expenses/purchaseorder/show')->with(compact(['organizations','purchaseorders','details','sums']));
        
    }

    public function createpdf(Request $request, $purchaseorder_id){
        $id = $request->session()->get('organization_id');
        $organization = new organization();
        $organizations = $organization->getorganization($id);
        $purchaseorder = new purchaseorder();
        $purchaseorders = $purchaseorder->selectPurchaseorderAll($id,$purchaseorder_id);
        $details = $purchaseorder->selectPurchaseorderRow($id,$purchaseorder_id);
        $sums = $purchaseorder->selectSum($id,$purchaseorder_id);
        // share data to view
        $pdf = PDF::loadView('expenses/purchaseorder/pdf', compact('organizations','purchaseorders','details','sums'));

        // download PDF file with download method
        return $pdf->download('purchaseorder.pdf');
        
    }

    public function preview(Request $request){
        $id = $request->session()->get('organization_id');
        $expenses_id = request()->input('expenses_id'); 
        $purchaseorder = new purchaseorder();
        $expensess = $purchaseorder->preview($id,$expenses_id);
        return response()->json($expensess, 200);
    }
    
    

}
