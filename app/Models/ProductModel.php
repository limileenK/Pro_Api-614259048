<?php 

namespace App\Models;
use CodeIgniter\Model;
class ProductModel extends Model{
    protected $table = 'products';//กำหนด table 
    protected $primaryKey = "_id";//กำหนด primaryKry
    protected $allowedFields = [ '_id ','name','category','price','tags'];//กำหนด column 
}

?>