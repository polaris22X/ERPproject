<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Auth;



class purchaseorder extends Model
{
    public function createPurchaseorder($organization_id,$expenses_id,$lastid,$POID,$detail){
        $id = Auth::id();
        $unixTimeStamp = Carbon::now()->toDateTimeString();
        DB::connection('mysql')->insert("INSERT INTO `purchaseorder`(`organization_id`, `expenses_id`, `purchaseorder_id`, `created_at`, `updated_at`,`po_id`,`detail` ,`user_id`) VALUES (?,?,?,?,?,?,?,?)",
        [$organization_id,$expenses_id,$lastid,$unixTimeStamp,$unixTimeStamp,$POID,$detail,$id]);
        DB::connection('mysql')->update("UPDATE expenses SET  `updated_at` = ?, status_id = 1 , purchaseorder_id = ? WHERE organization_id= ? AND expenses_id= ?",
        [$unixTimeStamp,$lastid,$organization_id,$expenses_id]);
    }

    public function getreadytopurchaseorder($organization_id){
        return DB::connection('mysql')->select("SELECT count(*) as 'readytopurchaseorder' FROM (SELECT expenses_id FROM expenses WHERE organization_id = ? AND status_id = 0 GROUP BY expenses_id) AS sub;",[$organization_id]);
    }

    public function getreadytoaccept($organization_id){
        return DB::connection('mysql')->select("SELECT count(*) as 'readytoaccept' FROM (SELECT expenses_id FROM expenses WHERE organization_id = ? AND status_id = 1 GROUP BY expenses_id) AS sub;",[$organization_id]);
    }

    public function selectReadyToPurchaseorder($organization_id){
       return DB::connection('mysql')->select("SELECT expenses.expenses_id,`partner`.partner_name ,expenses.created_at,SUM(expenses.saleprice * expenses.amount) as 'sum' 
       FROM `expenses` INNER JOIN `partner` ON `partner`.partner_id = expenses.partner_id AND `partner`.organization_id = expenses.organization_id WHERE expenses.organization_id = ? AND expenses.status_id = 0 
       GROUP BY expenses.expenses_id,`partner`.partner_name,expenses.created_at
       ORDER BY expenses.expenses_id DESC",[$organization_id]);
   }
   public function selectlastid($organization_id){
        return DB::connection('mysql')->select("SELECT purchaseorder_id FROM purchaseorder WHERE organization_id = ? ORDER BY purchaseorder_id DESC LIMIT 1;",[$organization_id]);
    }
   public function SelectPurchaseorderAll($organization_id,$purchaseorder_id){
        return  DB::connection('mysql')->select("SELECT * FROM purchaseorder 
        INNER JOIN expenses ON purchaseorder.expenses_id = expenses.expenses_id AND purchaseorder.organization_id = expenses.organization_id AND purchaseorder.purchaseorder_id = expenses.purchaseorder_id
        INNER JOIN partner ON expenses.partner_id = partner.partner_id AND expenses.organization_id = partner.organization_id
        INNER JOIN product ON expenses.product_id = product.product_id AND expenses.organization_id = product.organization_id
        WHERE purchaseorder.organization_id = ? AND purchaseorder.purchaseorder_id = ?",
        [$organization_id,$purchaseorder_id]);  
    }
    public function SelectPurchaseorderRow($organization_id,$purchaseorder_id){
        return  DB::connection('mysql')->select("SELECT purchaseorder.po_id,partner.partner_name,expenses.address,purchaseorder.purchaseorder_id,partner.partner_tel,partner.partner_email,purchaseorder.created_at FROM purchaseorder 
        INNER JOIN expenses ON purchaseorder.expenses_id = expenses.expenses_id AND purchaseorder.organization_id = expenses.organization_id AND purchaseorder.purchaseorder_id = expenses.purchaseorder_id
        INNER JOIN partner ON expenses.partner_id = partner.partner_id AND expenses.organization_id = partner.organization_id
        INNER JOIN product ON expenses.product_id = product.product_id AND expenses.organization_id = product.organization_id
        WHERE purchaseorder.organization_id = ? AND purchaseorder.purchaseorder_id = ? LIMIT 1",
        [$organization_id,$purchaseorder_id]);
    }

    public function selectSum($organization_id,$purchaseorder_id){
        return  DB::connection('mysql')->select("SELECT purchaseorder.purchaseorder_id,purchaseorder.detail,`partner`.partner_name ,purchaseorder.created_at,SUM(expenses.saleprice * expenses.amount) as 'sum' FROM purchaseorder 
        INNER JOIN expenses ON purchaseorder.expenses_id = expenses.expenses_id AND purchaseorder.organization_id = expenses.organization_id AND purchaseorder.purchaseorder_id = expenses.purchaseorder_id
        INNER JOIN partner ON expenses.partner_id = partner.partner_id AND expenses.organization_id = partner.organization_id
        INNER JOIN product ON expenses.product_id = product.product_id AND expenses.organization_id = product.organization_id
        WHERE purchaseorder.organization_id = ? AND purchaseorder.purchaseorder_id = ? GROUP BY purchaseorder.purchaseorder_id,`partner`.partner_name,purchaseorder.created_at,purchaseorder.detail;",
        [$organization_id,$purchaseorder_id]);
    }

   public function preview($organization_id,$expenses_id){
       
       return DB::connection('mysql')->select("SELECT *,`purchaseorder`.created_at as 'purchaseorder_date' FROM expenses
       INNER JOIN `partner` ON `partner`.partner_id = expenses.partner_id AND `partner`.organization_id = expenses.organization_id 
       INNER JOIN `product` ON `product`.product_id = expenses.product_id AND `product`.organization_id = expenses.organization_id 
       LEFT JOIN `purchaseorder` ON `purchaseorder`.purchaseorder_id = expenses.purchaseorder_id AND `purchaseorder`.purchaseorder_id = expenses.purchaseorder_id AND `purchaseorder`.expenses_id = expenses.expenses_id
        WHERE expenses.organization_id = ? AND expenses.expenses_id = ? ",[$organization_id,$expenses_id]);
   }

   public function selectPurchaseorder($organization_id){
        return  DB::connection('mysql')->select("SELECT purchaseorder.po_id,expenses.status_id,purchaseorder.expenses_id,purchaseorder.purchaseorder_id,`partner`.partner_name ,purchaseorder.created_at,SUM(expenses.saleprice * expenses.amount) as 'sum' FROM purchaseorder 
        INNER JOIN expenses ON purchaseorder.expenses_id = expenses.expenses_id AND purchaseorder.organization_id = expenses.organization_id AND purchaseorder.purchaseorder_id = expenses.purchaseorder_id
        INNER JOIN partner ON expenses.partner_id = partner.partner_id AND expenses.organization_id = partner.organization_id
        INNER JOIN product ON expenses.product_id = product.product_id AND expenses.organization_id = product.organization_id
        WHERE purchaseorder.organization_id = ? GROUP BY purchaseorder.po_id,expenses.status_id,purchaseorder.expenses_id,purchaseorder.purchaseorder_id,`partner`.partner_name,purchaseorder.created_at 
        ORDER BY purchaseorder.purchaseorder_id DESC;",
        [$organization_id]);
    }

    public function listtoaccept($organization_id){
        return  DB::connection('mysql')->select("SELECT purchaseorder.po_id,expenses.status_id,purchaseorder.expenses_id,purchaseorder.purchaseorder_id,`partner`.partner_name ,purchaseorder.created_at,SUM(expenses.saleprice * expenses.amount) as 'sum' FROM purchaseorder 
        INNER JOIN expenses ON purchaseorder.expenses_id = expenses.expenses_id AND purchaseorder.organization_id = expenses.organization_id AND purchaseorder.purchaseorder_id = expenses.purchaseorder_id
        INNER JOIN partner ON expenses.partner_id = partner.partner_id AND expenses.organization_id = partner.organization_id
        INNER JOIN product ON expenses.product_id = product.product_id AND expenses.organization_id = product.organization_id
        WHERE purchaseorder.organization_id = ? AND expenses.status_id = 1 GROUP BY purchaseorder.po_id,expenses.status_id,purchaseorder.expenses_id,purchaseorder.purchaseorder_id,`partner`.partner_name,purchaseorder.created_at
        ORDER BY purchaseorder.purchaseorder_id DESC;;",
        [$organization_id]);

    }

    public function PurchaseorderAccept($organization_id,$expenses_id,$unixTimeStamp){
        DB::connection('mysql')->update("UPDATE expenses SET  `updated_at` = ?, status_id = 2 WHERE organization_id= ? AND expenses_id= ?",
        [$unixTimeStamp,$organization_id,$expenses_id]);
    }
}
