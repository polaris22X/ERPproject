<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use auth;
use Carbon\Carbon;
class product extends Model
{
    protected $fillable = [
        'product_id', 'organization_id','product_name','stock'
    ];
    public function insert($lastid,$organization_id,$product_name,$product_description){
        $unixTimeStamp = Carbon::now()->toDateTimeString();
        DB::connection('mysql')->insert("INSERT INTO product(product_id, organization_id,product_name, product_description, stock, created_at, updated_at) 
        VALUES (?,?,?,?,?,?,?)",[$lastid,$organization_id,$product_name,$product_description,0,$unixTimeStamp,$unixTimeStamp]);
    }
    public function updateaddstock($organization_id,$product_id,$stock){
        $product = DB::connection('mysql')->select("SELECT * FROM product WHERE organization_id = ? AND product_id = ?;",[$organization_id,$product_id]);
        $nowstock = 0;
        foreach ($product as $stocks) {
            $nowstock = $stock + $stocks->stock;
        }
        DB::connection('mysql')->update("UPDATE product SET stock = ? WHERE organization_id = ? AND product_id = ?;",[$nowstock,$organization_id,$product_id]);
    }
    
    public function updatesalestock($organization_id,$product_id,$stocktosale){
        $product = DB::connection('mysql')->select("SELECT * FROM product WHERE organization_id = ? AND product_id = ?;",[$organization_id,$product_id]);
        $nowstock = 0;
        foreach ($product as $stocks) {
            $nowstock = $stocks->stock - $stocktosale;
        }
        DB::connection('mysql')->update("UPDATE product SET stock = ? WHERE organization_id = ? AND product_id = ?;",[$nowstock,$organization_id,$product_id]);
    }

    public function selectedit($organization_id,$idproduct){
        return DB::connection('mysql')->select("SELECT * FROM organizations
        INNER JOIN product ON organizations.id = product.organization_id
        WHERE organizations.id = ? AND product.product_id = ?;
        ",[$organization_id,$idproduct]);
    }
    
    public function select($organization_id){
        return DB::connection('mysql')->select("SELECT * FROM organizations
        INNER JOIN product ON organizations.id = product.organization_id
        WHERE organizations.id = ?;
        ",[$organization_id]);
    }
    public function selectlastid($organization_id){
        return DB::connection('mysql')->select("SELECT product_id FROM product WHERE organization_id = ? ORDER BY product_id DESC LIMIT 1;",[$organization_id]);
    }

    public function updatedo($organization_id,$product_id,$product_name,$product_description,$uinxTimeStamp){
       DB::connection('mysql')->update("UPDATE product SET product_name = ? , product_description = ?,updated_at = ? WHERE organization_id = ? AND product_id = ?;",[$product_name,$product_description,$uinxTimeStamp,$organization_id,$product_id]);
    }
}
