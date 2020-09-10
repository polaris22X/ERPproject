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
        
        DB::connection('mysql')->update("UPDATE income SET product_id= ?,saleprice= ?,amount= ?,partner_id= ? ,address= ?,updated_at= ? 
        WHERE organization_id= ? AND income_id= ? AND product_id= ?",
        [$product_id,$product_price,$product_amount,$partner_id,$address,$unixTimeStamp,$organization_id,$income_id,$oldproduct_id]);
    }
    
    public function deleteproduct($organization_id,$income_id,$product_id){
        
        DB::connection('mysql')->delete("DELETE FROM `income` WHERE  organization_id= ? AND income_id= ? AND product_id= ?",
        [$organization_id,$income_id,$product_id]);
    }

    public function insert($lastid,$organization_id,$product_id,$product_price,$product_amount,$partner_id,$partner_address,$unixTimeStamp){
        
        DB::connection('mysql')->insert("INSERT INTO `income`(`income_id`, `organization_id`, `product_id`, `saleprice`, `amount`, `partner_id`, `address`, `status_id`, `created_at`, `updated_at`) 
        VALUES (?,?,?,?,?,?,?,?,?,?)",[$lastid,$organization_id,$product_id,$product_price,$product_amount,$partner_id,$partner_address,0,$unixTimeStamp,$unixTimeStamp]);
    }
    public function insertedit($lastid,$organization_id,$product_id,$product_price,$product_amount,$partner_id,$partner_address,$created_at,$unixTimeStamp,$status_id,$quotation_id){
        
        DB::connection('mysql')->insert("INSERT INTO `income`(`income_id`, `organization_id`, `product_id`, `saleprice`, `amount`, `partner_id`, `address`, `status_id`, `quotation_id`,`created_at`, `updated_at`) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?)",[$lastid,$organization_id,$product_id,$product_price,$product_amount,$partner_id,$partner_address,$status_id,$quotation_id,$created_at,$unixTimeStamp]);
    }
    public function selectlastid($organization_id){
        return DB::connection('mysql')->select("SELECT income_id FROM income WHERE organization_id = ? ORDER BY income_id DESC LIMIT 1;",[$organization_id]);
    }
    public function select($organization_id){
        return DB::connection('mysql')->select("SELECT income.income_id,`partner`.partner_name ,income.created_at,SUM(income.saleprice * income.amount) as 'sum' 
        FROM `income` 
        INNER JOIN `partner` ON `partner`.partner_id = income.partner_id AND `partner`.organization_id = income.organization_id 
        WHERE income.organization_id = ? 
        GROUP BY income.income_id,`partner`.partner_name,income.created_at
        ORDER BY income_id DESC",[$organization_id]);
    }

    public function selectReadyToQuotation($organization_id){
       
       return DB::connection('mysql')->select("SELECT income.income_id,`partner`.partner_name ,income.created_at,SUM(income.saleprice * income.amount) as 'sum' 
       FROM `income` INNER JOIN `partner` ON `partner`.partner_id = income.partner_id AND `partner`.organization_id = income.organization_id WHERE income.organization_id = ? AND income.status_id = 0 
       GROUP BY income.income_id,`partner`.partner_name,income.created_at
       ORDER BY income.income_id DESC",[$organization_id]);
   }

    public function getdata($organization_id,$income_id){
       
       return DB::connection('mysql')->select("SELECT * FROM income
        WHERE income.organization_id = ? AND income.income_id = ? ",[$organization_id,$income_id]);
   }

   public function preview($organization_id,$income_id){
       
       return DB::connection('mysql')->select("SELECT * FROM income
       INNER JOIN `partner` ON `partner`.partner_id = income.partner_id AND `partner`.organization_id = income.organization_id 
       INNER JOIN `product` ON `product`.product_id = income.product_id AND `product`.organization_id = income.organization_id 
        WHERE income.organization_id = ? AND income.income_id = ? ",[$organization_id,$income_id]);
   }
   public function getpartner($organization_id,$income_id){
       
       return DB::connection('mysql')->select("SELECT * FROM income
        WHERE income.organization_id = ? AND income.income_id = ? LIMIT 1;",[$organization_id,$income_id]);
   }
  
}
