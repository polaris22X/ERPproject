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
    public function updatestock($organization_id,$productid,$stock){
        $product = DB::connection('mysql')->select("SELECT * FROM organizations INNER JOIN product ON organizations.id = product.organization_id WHERE organizations.id = ? AND product_id = ?;",[$organization_id,$product_id]);
        $nowstock = $stock + $product->stock;
        DB::connection('mysql')->update("UPDATE product SET stock = ? WHERE organizations.id = ? AND product_id = ?;",[$nowstock,$organization_id,$product_id]);
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
}
