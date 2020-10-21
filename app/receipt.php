<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Auth;

class receipt extends Model
{
    public function getReadyToReceipt($organization_id){
        return DB::connection('mysql')->select("SELECT count(*) as 'readytoreceipt' FROM (SELECT income_id FROM income WHERE organization_id = ? AND status_id = 3 GROUP BY income_id) AS sub;",[$organization_id]);
    }

    public function selectlastid($organization_id){
        return DB::connection('mysql')->select("SELECT receipt_id FROM receipt WHERE organization_id = ? ORDER BY receipt_id DESC LIMIT 1;",[$organization_id]);
    }

    public function selectReadyToReceipt($organization_id){
       
       return DB::connection('mysql')->select("SELECT invoice.inv_id,income.income_id,income.invoice_id,`partner`.partner_name ,invoice.created_at,SUM(income.saleprice * income.amount) as 'sum' 
       FROM `income` 
       INNER JOIN `partner` ON `partner`.partner_id = income.partner_id AND `partner`.organization_id = income.organization_id 
       INNER JOIN `invoice` ON `invoice`.invoice_id = income.invoice_id AND `invoice`.organization_id = income.organization_id
       WHERE income.organization_id = ? AND income.status_id = 3 
       GROUP BY invoice.inv_id,income.income_id,income.invoice_id,`partner`.partner_name,invoice.created_at
       ORDER BY invoice.created_at DESC",[$organization_id]);
   }
   public function SelectReceiptAll($organization_id,$receipt_id){
        return  DB::connection('mysql')->select("SELECT * FROM receipt 
        INNER JOIN income ON receipt.income_id = income.income_id AND receipt.organization_id = income.organization_id AND receipt.receipt_id = income.receipt_id
        INNER JOIN partner ON income.partner_id = partner.partner_id AND income.organization_id = partner.organization_id
        INNER JOIN product ON income.product_id = product.product_id AND income.organization_id = product.organization_id
        WHERE receipt.organization_id = ? AND receipt.receipt_id = ?",
        [$organization_id,$receipt_id]);  
    }
    public function SelectReceiptRow($organization_id,$receipt_id){
        return  DB::connection('mysql')->select("SELECT receipt.rt_id,partner.partner_name,income.address,receipt.receipt_id,partner.partner_tel,partner.partner_email,receipt.created_at FROM receipt 
        INNER JOIN income ON receipt.income_id = income.income_id AND receipt.organization_id = income.organization_id AND receipt.receipt_id = income.receipt_id
        INNER JOIN partner ON income.partner_id = partner.partner_id AND income.organization_id = partner.organization_id
        INNER JOIN product ON income.product_id = product.product_id AND income.organization_id = product.organization_id
        WHERE receipt.organization_id = ? AND receipt.receipt_id = ? LIMIT 1",
        [$organization_id,$receipt_id]);
    }

  
   public function createReceipt($organization_id,$income_id,$lastid,$RTID){
        $id = Auth::id();
        $unixTimeStamp = Carbon::now()->toDateTimeString();
        DB::connection('mysql')->insert("INSERT INTO `receipt`(`organization_id`, `income_id`, `receipt_id`, `created_at`, `updated_at`,`rt_id`,`user_id` ) VALUES (?,?,?,?,?,?,?)",
        [$organization_id,$income_id,$lastid,$unixTimeStamp,$unixTimeStamp,$RTID,$id]);
        DB::connection('mysql')->update("UPDATE income SET  `updated_at` = ?, status_id = 4 , receipt_id = ? WHERE organization_id= ? AND income_id= ?",
        [$unixTimeStamp,$lastid,$organization_id,$income_id]);
    }
    public function selectReceipt($organization_id){
        return  DB::connection('mysql')->select("SELECT receipt.rt_id,income.status_id,receipt.income_id,receipt.receipt_id,`partner`.partner_name ,receipt.created_at,SUM(income.saleprice * income.amount) as 'sum' FROM receipt 
        INNER JOIN income ON receipt.income_id = income.income_id AND receipt.organization_id = income.organization_id AND receipt.receipt_id = income.receipt_id
        INNER JOIN partner ON income.partner_id = partner.partner_id AND income.organization_id = partner.organization_id
        INNER JOIN product ON income.product_id = product.product_id AND income.organization_id = product.organization_id
        WHERE receipt.organization_id = ? GROUP BY receipt.rt_id,income.status_id,receipt.income_id,receipt.receipt_id,`partner`.partner_name,receipt.created_at 
        ORDER BY receipt.created_at DESC;",
        [$organization_id]);
    }

    public function selectSum($organization_id,$receipt_id){
        return  DB::connection('mysql')->select("SELECT receipt.receipt_id,`partner`.partner_name ,receipt.created_at,SUM(income.saleprice * income.amount) as 'sum' FROM receipt 
        INNER JOIN income ON receipt.income_id = income.income_id AND receipt.organization_id = income.organization_id AND receipt.receipt_id = income.receipt_id
        INNER JOIN partner ON income.partner_id = partner.partner_id AND income.organization_id = partner.organization_id
        INNER JOIN product ON income.product_id = product.product_id AND income.organization_id = product.organization_id
        WHERE receipt.organization_id = ? AND receipt.receipt_id = ? GROUP BY receipt.receipt_id,`partner`.partner_name,receipt.created_at;",
        [$organization_id,$receipt_id]);
    }
}
