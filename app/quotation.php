<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Auth;

class quotation extends Model
{
    
    public function createQuotation($organization_id,$income_id,$lastid,$QTID,$detail){
        $id = Auth::id();
        $unixTimeStamp = Carbon::now()->toDateTimeString();
        DB::connection('mysql')->insert("INSERT INTO `quotation`(`organization_id`, `income_id`, `quotation_id`, `created_at`, `updated_at`,`qt_id` ,`detail`,`user_id`) VALUES (?,?,?,?,?,?,?,?)",
        [$organization_id,$income_id,$lastid,$unixTimeStamp,$unixTimeStamp,$QTID,$detail,$id]);
        DB::connection('mysql')->update("UPDATE income SET  `updated_at` = ?, status_id = 1 , quotation_id = ? WHERE organization_id= ? AND income_id= ?",
        [$unixTimeStamp,$lastid,$organization_id,$income_id]);
    }
    public function QuotationAccept($organization_id,$income_id,$unixTimeStamp){
        
        DB::connection('mysql')->update("UPDATE income SET  `updated_at` = ?, status_id = 2 WHERE organization_id= ? AND income_id= ?",
        [$unixTimeStamp,$organization_id,$income_id]);
    }
    public function selectlastid($organization_id){
        return DB::connection('mysql')->select("SELECT quotation_id FROM quotation WHERE organization_id = ? ORDER BY quotation_id DESC LIMIT 1;",[$organization_id]);
    }
    public function selectQuotation($organization_id){
        return  DB::connection('mysql')->select("SELECT quotation.qt_id,income.status_id,quotation.income_id,quotation.quotation_id,`partner`.partner_name ,quotation.created_at,SUM(income.saleprice * income.amount) as 'sum' FROM quotation 
        INNER JOIN income ON quotation.income_id = income.income_id AND quotation.organization_id = income.organization_id AND quotation.quotation_id = income.quotation_id
        INNER JOIN partner ON income.partner_id = partner.partner_id AND income.organization_id = partner.organization_id
        INNER JOIN product ON income.product_id = product.product_id AND income.organization_id = product.organization_id
        WHERE quotation.organization_id = ? GROUP BY quotation.qt_id,income.status_id,quotation.income_id,quotation.quotation_id,`partner`.partner_name,quotation.created_at 
        ORDER BY quotation.created_at DESC;",
        [$organization_id]);
    }
    public function listtoaccept($organization_id){
        return  DB::connection('mysql')->select("SELECT quotation.qt_id,income.status_id,quotation.income_id,quotation.quotation_id,`partner`.partner_name ,quotation.created_at,SUM(income.saleprice * income.amount) as 'sum' FROM quotation 
        INNER JOIN income ON quotation.income_id = income.income_id AND quotation.organization_id = income.organization_id AND quotation.quotation_id = income.quotation_id
        INNER JOIN partner ON income.partner_id = partner.partner_id AND income.organization_id = partner.organization_id
        INNER JOIN product ON income.product_id = product.product_id AND income.organization_id = product.organization_id
        WHERE quotation.organization_id = ? AND income.status_id = 1 GROUP BY quotation.qt_id,income.status_id,quotation.income_id,quotation.quotation_id,`partner`.partner_name,quotation.created_at
        ORDER BY quotation.created_at DESC;",
        [$organization_id]);
    }
    public function SelectQuotationAll($organization_id,$quotation_id){
        return  DB::connection('mysql')->select("SELECT * FROM quotation 
        INNER JOIN income ON quotation.income_id = income.income_id AND quotation.organization_id = income.organization_id AND quotation.quotation_id = income.quotation_id
        INNER JOIN partner ON income.partner_id = partner.partner_id AND income.organization_id = partner.organization_id
        INNER JOIN product ON income.product_id = product.product_id AND income.organization_id = product.organization_id
        WHERE quotation.organization_id = ? AND quotation.quotation_id = ?",
        [$organization_id,$quotation_id]);  
    }
    public function SelectQuotationRow($organization_id,$quotation_id){
        return  DB::connection('mysql')->select("SELECT quotation.qt_id,partner.partner_name,income.address,quotation.quotation_id,partner.partner_tel,partner.partner_email,quotation.created_at FROM quotation 
        INNER JOIN income ON quotation.income_id = income.income_id AND quotation.organization_id = income.organization_id AND quotation.quotation_id = income.quotation_id
        INNER JOIN partner ON income.partner_id = partner.partner_id AND income.organization_id = partner.organization_id
        INNER JOIN product ON income.product_id = product.product_id AND income.organization_id = product.organization_id
        WHERE quotation.organization_id = ? AND quotation.quotation_id = ? LIMIT 1",
        [$organization_id,$quotation_id]);
    }
    public function selectSum($organization_id,$quotation_id){
        return  DB::connection('mysql')->select("SELECT quotation.detail,quotation.quotation_id,`partner`.partner_name ,quotation.created_at,SUM(income.saleprice * income.amount) as 'sum' FROM quotation 
        INNER JOIN income ON quotation.income_id = income.income_id AND quotation.organization_id = income.organization_id AND quotation.quotation_id = income.quotation_id
        INNER JOIN partner ON income.partner_id = partner.partner_id AND income.organization_id = partner.organization_id
        INNER JOIN product ON income.product_id = product.product_id AND income.organization_id = product.organization_id
        WHERE quotation.organization_id = ? AND quotation.quotation_id = ? GROUP BY quotation.detail,quotation.quotation_id,`partner`.partner_name,quotation.created_at;",
        [$organization_id,$quotation_id]);
    }
}
