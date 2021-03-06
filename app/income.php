<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use auth;
use Carbon\Carbon;

class income extends Model
{
    public function getreadytoquotation($organization_id){
        return DB::connection('mysql')->select("SELECT count(*) as 'readytoquotation' FROM (SELECT income_id FROM income WHERE organization_id = ? AND status_id = 0 GROUP BY income_id) AS sub;",[$organization_id]);
    }
    public function getreadytoaccept($organization_id){
        return DB::connection('mysql')->select("SELECT count(*) as 'readytoaccept' FROM (SELECT income_id FROM income WHERE organization_id = ? AND status_id = 1 GROUP BY income_id) AS sub;",[$organization_id]);
    }
    

    public function edit($income_id,$organization_id,$product_id,$product_price,$product_amount,$partner_id,$address,$oldproduct_id,$unixTimeStamp){
        $id = Auth::id();
        DB::connection('mysql')->update("UPDATE income SET product_id= ?,saleprice= ?,amount= ?,partner_id= ? ,address= ?,updated_at= ? , `user_id` = ?
        WHERE organization_id= ? AND income_id= ? AND product_id= ?",
        [$product_id,$product_price,$product_amount,$partner_id,$address,$unixTimeStamp,$id,$organization_id,$income_id,$oldproduct_id]);
    }
    
    public function deleteproduct($organization_id,$income_id,$product_id){
        
        DB::connection('mysql')->delete("DELETE FROM `income` WHERE  organization_id= ? AND income_id= ? AND product_id= ?",
        [$organization_id,$income_id,$product_id]);
    }

    public function insert($lastid,$organization_id,$product_id,$product_price,$product_amount,$partner_id,$partner_address,$unixTimeStamp){
        $id = Auth::id();
        DB::connection('mysql')->insert("INSERT INTO `income`(`income_id`, `organization_id`, `product_id`, `saleprice`, `amount`, `partner_id`, `address`, `status_id`, `created_at`, `updated_at`,`user_id`) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?)",[$lastid,$organization_id,$product_id,$product_price,$product_amount,$partner_id,$partner_address,0,$unixTimeStamp,$unixTimeStamp,$id]);
    }
    public function insertedit($lastid,$organization_id,$product_id,$product_price,$product_amount,$partner_id,$partner_address,$created_at,$unixTimeStamp,$status_id,$quotation_id){
        $id = Auth::id();
        DB::connection('mysql')->insert("INSERT INTO `income`(`income_id`, `organization_id`, `product_id`, `saleprice`, `amount`, `partner_id`, `address`, `status_id`, `quotation_id`,`created_at`, `updated_at`,`user_id`) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?)",[$lastid,$organization_id,$product_id,$product_price,$product_amount,$partner_id,$partner_address,$status_id,$quotation_id,$created_at,$unixTimeStamp,$id]);
    }
    public function selectlastid($organization_id){
        return DB::connection('mysql')->select("SELECT income_id FROM income WHERE organization_id = ? ORDER BY income_id DESC LIMIT 1;",[$organization_id]);
    }
    public function select($organization_id){
        return DB::connection('mysql')->select("SELECT income.income_id,`partner`.partner_name,income.status_id,status_income.status_name ,income.created_at,SUM(income.saleprice * income.amount) as 'sum' 
        FROM `income` 
        INNER JOIN `partner` ON `partner`.partner_id = income.partner_id AND `partner`.organization_id = income.organization_id 
        INNER JOIN `status_income` ON `status_income`.status_id = `income`.status_id 
        WHERE income.organization_id = ? 
        GROUP BY income.income_id,`partner`.partner_name,income.created_at,income.status_id,status_income.status_name
        ORDER BY created_at DESC",[$organization_id]);
    }

    public function selectReadyToQuotation($organization_id){
       
       return DB::connection('mysql')->select("SELECT income.income_id,`partner`.partner_name ,income.created_at,SUM(income.saleprice * income.amount) as 'sum' 
       FROM `income` INNER JOIN `partner` ON `partner`.partner_id = income.partner_id AND `partner`.organization_id = income.organization_id WHERE income.organization_id = ? AND income.status_id = 0 
       GROUP BY income.income_id,`partner`.partner_name,income.created_at
       ORDER BY income.created_at DESC",[$organization_id]);
   }

    public function getdata($organization_id,$income_id){
       
       return DB::connection('mysql')->select("SELECT * FROM income
        WHERE income.organization_id = ? AND income.income_id = ? ",[$organization_id,$income_id]);
   }

   public function preview($organization_id,$income_id){
       
       return DB::connection('mysql')->select("SELECT *,quotation.created_at as 'quotation_date' FROM income
       INNER JOIN `partner` ON `partner`.partner_id = income.partner_id AND `partner`.organization_id = income.organization_id 
       INNER JOIN `product` ON `product`.product_id = income.product_id AND `product`.organization_id = income.organization_id
       LEFT JOIN `quotation` ON `quotation`.quotation_id = income.quotation_id AND `quotation`.organization_id = income.organization_id AND `quotation`.income_id = income.income_id
        WHERE income.organization_id = ? AND income.income_id = ? ",[$organization_id,$income_id]);
   }
   public function getpartner($organization_id,$income_id){
       
       return DB::connection('mysql')->select("SELECT * FROM income
        WHERE income.organization_id = ? AND income.income_id = ? LIMIT 1;",[$organization_id,$income_id]);
   }
  
}
