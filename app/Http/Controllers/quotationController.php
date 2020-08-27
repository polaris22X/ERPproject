<?php

namespace App\Http\Controllers;
use App\organization;
use App\income;
use App\quotation;
use PDF;
use Illuminate\Http\Request;

class quotationController extends Controller
{
    public function index(Request $reqeust){
        $id = $reqeust->session()->get('organization_id');
        $organization = new organization();
        $quotation = new quotation();
        $income = new income();
        $organizations = $organization->getorganization($id);
        $readytoquotation = $quotation->getreadytoquotation($id);
        $incomes = $income->selectReadyToQuotation($id);
        $quotations = $quotation->selectQuotation($id);
        return view('income/quotation/listquotation')->with(compact(['organizations','readytoquotation','incomes','quotations']));
    }

    public function show(Request $reqeust, $quotation_id){
        $id = $reqeust->session()->get('organization_id');
        $organization = new organization();
        $organizations = $organization->getorganization($id);
        $quotation = new quotation();
        $quotations = $quotation->selectQuotationAll($id,$quotation_id);
        $details = $quotation->selectQuotationRow($id,$quotation_id);
        $sums = $quotation->selectSum($id,$quotation_id);
        return view('income/quotation/showquotation')->with(compact(['organizations','quotations','details','sums']));
        
    }

    public function createQuotation(Request $reqeust, $income_id){
        
        $organization_id = $reqeust->session()->get('organization_id');
        $quotation = new quotation();
        $data = $quotation->selectlastid($organization_id);
        if($data){
            foreach($data as $id){
            $lastid = $id->quotation_id;
            }
        $lastid = $lastid + 1;
        }
        else{
            $lastid = 1; 
        }
        $quotation->createQuotation($organization_id,$income_id,$lastid);
        return redirect()->action('quotationController@index');
    }

    public function createpdf(Request $reqeust, $quotation_id){
        $id = $reqeust->session()->get('organization_id');
        $organization = new organization();
        $organizations = $organization->getorganization($id);
        $quotation = new quotation();
        $quotations = $quotation->selectQuotationAll($id,$quotation_id);
        $details = $quotation->selectQuotationRow($id,$quotation_id);
        $sums = $quotation->selectSum($id,$quotation_id);
        // share data to view
        $pdf = PDF::loadView('income/quotation/quotationpdf', compact('organizations','quotations','details','sums'));

        // download PDF file with download method
        return $pdf->download('quotation.pdf');
        
    }
    
}
