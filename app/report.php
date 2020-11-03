<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;

class report extends Model
{
    public function sumincome($organization_id){
        return DB::connection('mysql')->select("SELECT SUM(saleprice * amount)AS 'sumincome' FROM `income` WHERE status_id >= 3 AND organization_id = ?",[$organization_id]);
    }
    public function sumexpenses($organization_id){
        return DB::connection('mysql')->select("SELECT SUM(saleprice * amount)AS 'sumexpenses' FROM `expenses` WHERE status_id >= 1 AND organization_id = ?",[$organization_id]);
    }

    public function sumincome1month($organization_id){
        return DB::connection('mysql')->select("SELECT SUM(saleprice * amount)AS 'sumincome' FROM `income` INNER JOIN `invoice` ON `income`.`organization_id` = `invoice`.organization_id AND `income`.invoice_id = `invoice`.invoice_id AND `income`.income_id = `invoice`.income_id WHERE income.status_id >= 3 AND income.organization_id = ? AND YEAR(invoice.created_at) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND MONTH(invoice.created_at) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)",[$organization_id]);
    }
    public function sumexpenses1month($organization_id){
        return DB::connection('mysql')->select("SELECT SUM(saleprice * amount)AS 'sumexpenses' FROM `expenses` INNER JOIN `purchaseorder` ON `expenses`.`organization_id` = `purchaseorder`.organization_id AND `expenses`.purchaseorder_id = `purchaseorder`.purchaseorder_id AND `expenses`.expenses_id = `purchaseorder`.expenses_id WHERE expenses.status_id >= 1 AND expenses.organization_id = ? AND YEAR(purchaseorder.created_at) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
AND MONTH(purchaseorder.created_at) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)",[$organization_id]);
    }

    public function sumincome3month($organization_id){
        return DB::connection('mysql')->select("SELECT SUM(saleprice * amount) AS 'sumincome' FROM `income` INNER JOIN `invoice` ON `income`.`organization_id` = `invoice`.organization_id AND `income`.invoice_id = `invoice`.invoice_id AND `income`.income_id = `invoice`.income_id WHERE income.status_id >= 3 AND income.organization_id = ? AND YEAR(invoice.created_at) >= YEAR(CURRENT_DATE - INTERVAL 3 MONTH) AND MONTH(invoice.created_at) >= MONTH(CURRENT_DATE - INTERVAL 3 MONTH) AND MONTH(invoice.created_at) < MONTH(CURRENT_DATE)",[$organization_id]);
    }
    public function sumexpenses3month($organization_id){
        return DB::connection('mysql')->select("SELECT SUM(saleprice * amount) AS 'sumexpenses' FROM `expenses` INNER JOIN `purchaseorder` ON `expenses`.`organization_id` = `purchaseorder`.organization_id AND `expenses`.purchaseorder_id = `purchaseorder`.purchaseorder_id AND `expenses`.expenses_id = `purchaseorder`.expenses_id WHERE expenses.status_id >= 1 AND expenses.organization_id = ? AND YEAR(purchaseorder.created_at) >= YEAR(CURRENT_DATE - INTERVAL 3 MONTH) AND MONTH(purchaseorder.created_at) >= MONTH(CURRENT_DATE - INTERVAL 3 MONTH) AND MONTH(purchaseorder.created_at) < MONTH(CURRENT_DATE)",[$organization_id]);
    }
}
