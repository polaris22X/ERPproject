<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use auth;
use Carbon\Carbon;


class expenses extends Model
{
    public function insert($lastid,$organization_id,$product_id,$product_price,$product_amount,$partner_id,$partner_address,$unixTimeStamp){
        $id = Auth::id();
        DB::connection('mysql')->insert("INSERT INTO `expenses`(`expenses_id`, `organization_id`, `product_id`, `saleprice`, `amount`, `partner_id`, `address`, `status_id`, `created_at`, `updated_at`,`user_id`) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?)",[$lastid,$organization_id,$product_id,$product_price,$product_amount,$partner_id,$partner_address,0,$unixTimeStamp,$unixTimeStamp,$id]);
    }
    public function selectlastid($organization_id){
        return DB::connection('mysql')->select("SELECT expenses_id FROM expenses WHERE organization_id = ? ORDER BY expenses_id DESC LIMIT 1;",[$organization_id]);
    }

    public function select($organization_id){
        return DB::connection('mysql')->select("SELECT expenses.expenses_id,`partner`.partner_name,expenses.status_id,status_expenses.status_name ,expenses.created_at,SUM(expenses.saleprice * expenses.amount) as 'sum' 
        FROM `expenses` 
        INNER JOIN `partner` ON `partner`.partner_id = expenses.partner_id AND `partner`.organization_id = expenses.organization_id 
        INNER JOIN `status_expenses` ON `status_expenses`.status_id = `expenses`.status_id 
        WHERE expenses.organization_id = ? 
        GROUP BY expenses.expenses_id,`partner`.partner_name,expenses.created_at,expenses.status_id,status_expenses.status_name
        ORDER BY expenses_id DESC",[$organization_id]);
    }

    public function getdata($organization_id,$expenses_id){
       
       return DB::connection('mysql')->select("SELECT * FROM expenses
        WHERE expenses.organization_id = ? AND expenses.expenses_id = ? ",[$organization_id,$expenses_id]);
   }
    
   public function getpartner($organization_id,$expenses_id){
       
       return DB::connection('mysql')->select("SELECT * FROM expenses
        WHERE expenses.organization_id = ? AND expenses.expenses_id = ? LIMIT 1;",[$organization_id,$expenses_id]);
   }

   public function edit($expenses_id,$organization_id,$product_id,$product_price,$product_amount,$partner_id,$address,$oldproduct_id,$unixTimeStamp){
        $id = Auth::id();
        DB::connection('mysql')->update("UPDATE expenses SET product_id= ?,saleprice= ?,amount= ?,partner_id= ? ,address= ?,updated_at= ? , user_id = ?
        WHERE organization_id= ? AND expenses_id= ? AND product_id= ?",
        [$product_id,$product_price,$product_amount,$partner_id,$address,$unixTimeStamp,$id,$organization_id,$expenses_id,$oldproduct_id]);
    }
    public function insertedit($lastid,$organization_id,$product_id,$product_price,$product_amount,$partner_id,$partner_address,$created_at,$unixTimeStamp,$status_id){
        $id = Auth::id();
        DB::connection('mysql')->insert("INSERT INTO `expenses`(`expenses_id`, `organization_id`, `product_id`, `saleprice`, `amount`, `partner_id`, `address`, `status_id`,`created_at`, `updated_at`,`user_id`) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?)",[$lastid,$organization_id,$product_id,$product_price,$product_amount,$partner_id,$partner_address,$status_id,$created_at,$unixTimeStamp,$id]);
    }
    public function deleteproduct($organization_id,$expenses_id,$product_id){
        
        DB::connection('mysql')->delete("DELETE FROM `expenses` WHERE  organization_id= ? AND expenses_id= ? AND product_id= ?",
        [$organization_id,$expenses_id,$product_id]);
    }
}
