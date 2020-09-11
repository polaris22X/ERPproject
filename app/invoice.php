<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use auth;
use Carbon\Carbon;



class invoice extends Model
{
    public function getReadyToInvoice($organization_id){
        return DB::connection('mysql')->select("SELECT count(*) as 'readytoinvoice' FROM (SELECT income_id FROM income WHERE organization_id = ? AND status_id = 2 GROUP BY income_id) AS sub;",[$organization_id]);
    }

    public function selectReadyToInvoice($organization_id){
       
       return DB::connection('mysql')->select("SELECT quotation.qt_id,income.income_id,income.quotation_id,`partner`.partner_name ,quotation.created_at,SUM(income.saleprice * income.amount) as 'sum' 
       FROM `income` 
       INNER JOIN `partner` ON `partner`.partner_id = income.partner_id AND `partner`.organization_id = income.organization_id 
       INNER JOIN `quotation` ON `quotation`.quotation_id = income.quotation_id AND `quotation`.organization_id = income.organization_id
       WHERE income.organization_id = ? AND income.status_id = 2 
       GROUP BY quotation.qt_id,income.income_id,income.quotation_id,`partner`.partner_name,quotation.created_at
       ORDER BY income.quotation_id DESC",[$organization_id]);
   }

   public function selectlastid($organization_id){
        return DB::connection('mysql')->select("SELECT invoice_id FROM invoice WHERE organization_id = ? ORDER BY invoice_id DESC LIMIT 1;",[$organization_id]);
    }

    public function createInvoice($organization_id,$income_id,$lastid,$INVID){
        $unixTimeStamp = Carbon::now()->toDateTimeString();
        DB::connection('mysql')->insert("INSERT INTO `invoice`(`organization_id`, `income_id`, `invoice_id`, `created_at`, `updated_at`,`inv_id`) VALUES (?,?,?,?,?,?)",
        [$organization_id,$income_id,$lastid,$unixTimeStamp,$unixTimeStamp,$INVID]);
        DB::connection('mysql')->update("UPDATE income SET  `updated_at` = ?, status_id = 3 , invoice_id = ? WHERE organization_id= ? AND income_id= ?",
        [$unixTimeStamp,$lastid,$organization_id,$income_id]);
    }

    public function selectInvoice($organization_id){
        return  DB::connection('mysql')->select("SELECT invoice.inv_id,income.status_id,invoice.income_id,invoice.invoice_id,`partner`.partner_name ,invoice.created_at,SUM(income.saleprice * income.amount) as 'sum' FROM invoice 
        INNER JOIN income ON invoice.income_id = income.income_id AND invoice.organization_id = income.organization_id AND invoice.invoice_id = income.invoice_id
        INNER JOIN partner ON income.partner_id = partner.partner_id AND income.organization_id = partner.organization_id
        INNER JOIN product ON income.product_id = product.product_id AND income.organization_id = product.organization_id
        WHERE invoice.organization_id = ? GROUP BY invoice.inv_id,income.status_id,invoice.income_id,invoice.invoice_id,`partner`.partner_name,invoice.created_at 
        ORDER BY invoice.invoice_id DESC;",
        [$organization_id]);
    }

    public function SelectInvoiceAll($organization_id,$invoice_id){
        return  DB::connection('mysql')->select("SELECT * FROM invoice 
        INNER JOIN income ON invoice.income_id = income.income_id AND invoice.organization_id = income.organization_id AND invoice.invoice_id = income.invoice_id
        INNER JOIN partner ON income.partner_id = partner.partner_id AND income.organization_id = partner.organization_id
        INNER JOIN product ON income.product_id = product.product_id AND income.organization_id = product.organization_id
        WHERE invoice.organization_id = ? AND invoice.invoice_id = ?",
        [$organization_id,$invoice_id]);  
    }
    public function SelectInvoiceRow($organization_id,$invoice_id){
        return  DB::connection('mysql')->select("SELECT invoice.inv_id,partner.partner_name,income.address,invoice.invoice_id,partner.partner_tel,partner.partner_email,invoice.created_at FROM invoice 
        INNER JOIN income ON invoice.income_id = income.income_id AND invoice.organization_id = income.organization_id AND invoice.invoice_id = income.invoice_id
        INNER JOIN partner ON income.partner_id = partner.partner_id AND income.organization_id = partner.organization_id
        INNER JOIN product ON income.product_id = product.product_id AND income.organization_id = product.organization_id
        WHERE invoice.organization_id = ? AND invoice.invoice_id = ? LIMIT 1",
        [$organization_id,$invoice_id]);
    }
    public function selectSum($organization_id,$invoice_id){
        return  DB::connection('mysql')->select("SELECT invoice.invoice_id,`partner`.partner_name ,invoice.created_at,SUM(income.saleprice * income.amount) as 'sum' FROM invoice 
        INNER JOIN income ON invoice.income_id = income.income_id AND invoice.organization_id = income.organization_id AND invoice.invoice_id = income.invoice_id
        INNER JOIN partner ON income.partner_id = partner.partner_id AND income.organization_id = partner.organization_id
        INNER JOIN product ON income.product_id = product.product_id AND income.organization_id = product.organization_id
        WHERE invoice.organization_id = ? AND invoice.invoice_id = ? GROUP BY invoice.invoice_id,`partner`.partner_name,invoice.created_at;",
        [$organization_id,$invoice_id]);
    }
}
